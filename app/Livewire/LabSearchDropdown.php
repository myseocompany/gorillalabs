<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Lab;

class LabSearchDropdown extends Component
{
    public $search = '';
    public $results = [];

    protected $listeners = ['updateSearch'];

    public function updateSearch($search)
    {
        $this->search = $search;
        $this->results = Lab::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function render()
    {
        return view('livewire.lab-search-dropdown');
    }
}
