<?php

namespace App\Livewire;

use Livewire\Component;

class TestComponent extends Component
{
    public $string = "algo";
    
    public function render()
    {
        return view('livewire.test-component');
    }
}
