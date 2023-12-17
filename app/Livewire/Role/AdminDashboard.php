<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
namespace App\Livewire\Role extends Component
{
    public function render()
    {
        $userCount = User::count();
  return('I am dashboard');
    }
       // return view('livewire.Role.layout.admin', compact('userCount'));        }
}
