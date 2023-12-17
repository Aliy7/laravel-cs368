<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads; // Use this trait for file uploads
new class extends Component
{
    use WithFileUploads;
    public string $name = '';
    public string $email = '';
    public $profile_picture; 
    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->username = Auth::user()->username;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }
  
    public function updateProfilePicture()
{
    $this->validate([
        'profile_picture' => 'nullable|image|max:2048',
    ]);

    if ($this->profile_picture) {
        $imagePath = $this->profile_picture->store('avatars', 'public');
        Auth::user()->profile()->updateOrCreate([], ['profile_picture' => $imagePath]);
    }

    $this->dispatchBrowserEvent('profile-picture-updated');}

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $path = session('url.intended', RouteServiceProvider::HOME);

            $this->redirect($path);

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

