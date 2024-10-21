<?php

namespace App\Livewire;

use Livewire\Component;

class ResultPage extends Component
{
    public $search = 'test';


    public function render()
    {
        return view('livewire.result-page');
    }
}
