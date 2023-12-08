<?php

namespace App\Livewire;

use Livewire\Component;

class TestForm extends Component
{
    public $testInput = '';

    public function submit()
    {
        logger('Form submitted');
    }

    public function render()
    {
        return view('livewire.test-form');
    }
}
