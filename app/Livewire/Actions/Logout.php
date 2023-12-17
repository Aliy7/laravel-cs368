<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

namespace App\Livewire\Actions
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke(): void
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();
    }
}
