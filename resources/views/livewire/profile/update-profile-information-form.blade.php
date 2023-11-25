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

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form wire:submit.prevent="updateProfileInformation" class="mt-6 space-y-6">
        <!-- Name and Email Fields -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- Submit Button for Name and Email -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>

    <!-- Separate Form for Profile Picture Upload -->
    <form wire:submit.prevent="updateProfilePicture" class="mt-6 space-y-6">
        <div>
            <x-input-label for="profile_picture" :value="__('Profile Picture')" />
            <input wire:model="profile_picture" id="profile_picture" name="profile_picture" type="file" class="mt-1 block w-full"/>
            @error('profile_picture') <span class="error text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Separate Submit Button for Profile Picture -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Upload Picture') }}</x-primary-button>
        </div>
    </form>
</section>
