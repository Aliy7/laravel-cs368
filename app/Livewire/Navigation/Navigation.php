<?php

namespace App\Livewire;
use Livewire\Component;
use App\Livewire\Actions\Logout;
class Navigation extends Component
{
    public function render()
    {
        return view('livewire.navigations.navigation');
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}
