<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TestMatrix;
use App\Models\TestActivity;
use App\Models\Test;

class LabList extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedMatrix = null;
    public $selectedTypes = []; // Tipos de servicio seleccionados
    public $showQuoteForm = false;
    public $name = '';
    public $email = '';
    public $message = '';
    public $selectedTestId = null;
    

    protected $queryString = ['search', 'selectedMatrix', 'selectedTypes'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
        $this->selectedTypes = request()->query('type', $this->selectedTypes);
    }

    public function toggleType($type)
    {
        // Si el tipo ya está seleccionado, eliminarlo, de lo contrario, agregarlo
        if (in_array($type, $this->selectedTypes)) {
            $this->selectedTypes = array_diff($this->selectedTypes, [$type]);
        } else {
            $this->selectedTypes[] = $type;
        }

        $this->resetPage(); // Reiniciar la paginación al cambiar la selección
    }

    public function selectMatrix($matrix)
    {
        if ($this->selectedMatrix === $matrix) {
            $this->selectedMatrix = null;
        } else {
            $this->selectedMatrix = $matrix;
        }
        $this->resetPage(); // Reiniciar la paginación al seleccionar una nueva matriz
    }

    public function render()
    {
        $matrices = TestMatrix::all();
        $testActivities = TestActivity::all();

        // Consulta para obtener los tests con paginación
        $tests = Test::with('lab')
            ->where('accreditation_status', 'Activa')
            ->when($this->selectedMatrix, function ($query) {
                $query->where('matrix', 'like', '%' . $this->selectedMatrix . '%');
            })
            ->when($this->search, function ($query) {
                $searchTerm = strtolower($this->search);
                $query->where(function ($subQuery) use ($searchTerm) {
                    $subQuery->whereRaw('LOWER(variable) like ?', ["%{$searchTerm}%"])
                        ->orWhereRaw('LOWER(matrix) like ?', ["%{$searchTerm}%"])
                        ->orWhereRaw('LOWER(activity) like ?', ["%{$searchTerm}%"])
                        ->orWhereRaw('LOWER(`group`) like ?', ["%{$searchTerm}%"])
                        ->orWhereHas('lab', function ($labQuery) use ($searchTerm) {
                            $labQuery->whereRaw('LOWER(name) like ?', ["%{$searchTerm}%"]);
                        });
                });
            })
            ->when($this->selectedTypes, function ($query) {
                $query->whereIn('activity', $this->selectedTypes);
            })
            ->paginate(10);

        return view('livewire.lab-list', [
            'matrices' => $matrices,
            'testActivities' => $testActivities,
            'tests' => $tests,
        ]);
    }

    public function openQuoteForm($testId)
    {
         // Esto imprimirá el ID del test y detendrá la ejecución
        $this->showQuoteForm = true;
        // Aquí puedes añadir lógica adicional para manejar el testId si es necesario
    }

    public function closeQuoteForm()
    {
        $this->showQuoteForm = false;
    }

    public function submitQuoteForm()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:500',
        ]);

        dd($this->name, $this->email, $this->message, $this->selectedTestId);

        // Lógica para manejar el envío del formulario

        $this->closeQuoteForm();
    }
}