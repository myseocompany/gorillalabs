<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TestMatrix;
use App\Models\Test;

class LabList extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedMatrix = null;

    protected $queryString = ['search', 'selectedMatrix'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function selectMatrix($matrix)
    {
        if ($this->selectedMatrix === $matrix) {
            $this->selectedMatrix = null;
        } else {
            $this->selectedMatrix = $matrix;
        }
        $this->resetPage(); // Resetear la paginación cuando se selecciona una nueva matriz
    }

    public function render()
    {
        $matrices = TestMatrix::all();

        // Consulta para obtener los tests con paginación
        $tests = Test::with('lab')
            ->where('accreditation_status', 'Activa')
            ->when($this->selectedMatrix, function ($query) {
                $query->where('matrix', 'like', '%' . $this->selectedMatrix . '%');
            })
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('variable', 'like', '%' . $this->search . '%')
                             ->orWhere('activity', 'like', '%' . $this->search . '%')
                             ->orWhere('group', 'like', '%' . $this->search . '%');
                });
            })
            ->paginate(10);

        return view('livewire.lab-list', [
            'matrices' => $matrices,
            'tests' => $tests,
        ]);
    }
}
