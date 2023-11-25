<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Notifications\ProfileUpdatedNotification;
use App\Models\User;

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
    
        // You can add any additional logic here if needed
    
        // Return the view with the user data
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user(); // Get the currently authenticated user

        // Fill user with validated request data
       $request -> $user->fill($request->validated());

        // Check if the email field has been modified
        if ( $request-> $user->isDirty('email')) {
            $user->email_verified_at = null;
            // Optionally: Trigger a process to send a new email verification notification
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
    
    // ...


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
