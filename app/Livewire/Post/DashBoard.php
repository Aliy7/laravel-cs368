<?php

namespace App\Livewire\Post;

use Livewire\Component;
use Livewire\Attributes\On;

class DashBoard extends Component
{

    protected $listeners = ['post-created' => 'handlePostCreated', 'postUpdated' => 'handlePostUpdated'];

    public function render()
    {
       return view('livewire.dash-board');
    }

    #[On('post-updated')]
    public function updatePost(){

    }
}
