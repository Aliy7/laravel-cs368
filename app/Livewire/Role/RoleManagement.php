<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Role; 
namespace App\Livewire\Role extends Component
{

    public $users;
    public $roles;
    public $selectedRoleId = [];
    
    public function mount()
    {
        $this->users = User::all();
        $this->roles = Role::all();
    }

    public function updateRoles()
    {
        foreach ($this->selectedRoleId as $userId => $roleId) {
            $user = User::find($userId);
            if ($user) {
                $user->roles()->sync($roleId);
            }
        }

        session()->flash('message', 'User roles updated successfully.');
    }

    public function render()
    {
        return view('livewire.user-role-management');
    }
    public function assignRole($userId)
{
    if(isset($this->selectedRoleId[$userId])) {
        $user = User::find($userId);
        if ($user) {
            $user->roles()->sync($this->selectedRoleId[$userId]);
            $this->dispatch('notify', 'Role assigned successfully.');
        }
    }
}

}
