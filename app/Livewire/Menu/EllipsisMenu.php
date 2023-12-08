<?php

namespace App\Livewire\Menu;

use Closure;
use Illuminate\Contracts\View\View;

use Livewire\Component;
class EllipsisMenu extends Component
{

    public $isOpen = false; 

    public $listeners = ['closeDropdown' => 'closeDropdown'];


    // Method to toggle the dropdown visibility
    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
    if ($this->isOpen) {
        $this->dispatch('dropdown-open');
    }
}

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('livewire.drop-menu.ellipsis-menu');
    }
}
