<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Notifications\ProfileUpdatedNotification;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    // public function edit(Request $request): View
    // {

    //     $user_id :: User;
    //     if(Auth::id()) != $user_id)
    // }

    public function edit(Request $request)
    {
        // Get the authenticated user's ID
        $userId = Auth::user()->id;
    
        // Find the user record based on the ID
        $user = User::findOrFail($userId);
        $profile = $user->profile;

        // You can add any additional logic here if needed
    
        // Return the view with the user data
        return view('profile.edit', compact('user'));
    }



    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user(); 
        $profile = $user->profile;
        
        $user->update([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ]);

        // Update profile details
        $profile->update([
            'bio' => $request->bio,
            'phone_number' => $request->phone_number,
            'date_of_birth' => $request->date_of_birth,
            'website_url' => $request->website_url,
            'location' => $request->location,
            // Add other profile fields if necessary
        ]);


       $request -> $user->fill($request->validated());

     
        if ( $request-> $user->isDirty('email')) {
            $user->email_verified_at = null;
      
        }

        $request->$user->save(); // Save the changes to the user

        // Send the profile updated notification
       $request-> $user->notify(new ProfileUpdatedNotification());

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $userProfile = Auth::user()->profile; 
        $profileImagePath = $request->file('profile_picture')->store('avatars', 'public');
        $userProfile->profile_picture = $profileImagePath;
        $userProfile->save();
    
        return back()->with('success', 'Profile picture updated successfully.');
    }
    
    //should be deleed later
    public function showPost()
    {
        // Retrieve all posts by the currently logged-in user
        $userPosts = Post::with('comments')->where('user_id', Auth::id())->get();
    
        // Retrieve other posts from the database
        $otherPosts = Post::with('comments')->where('user_id', '!=', Auth::id())->get();
    
        // Return the view with posts data
        return view('livewire.profile.show-posts', compact('userPosts', 'otherPosts'));
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function showProfile($userId)
{
    $user = User::findOrFail($userId);
 return view('profile', compact('user'));}

}
