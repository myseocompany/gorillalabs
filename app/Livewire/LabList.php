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
    public $showQuoteForm = false;
    public $name = '';
    public $email = '';
    public $message = '';
    public $selectedTestId = null;

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

    public function openQuoteForm($testId)
    {
        $this->selectedTestId = $testId;
        $this->showQuoteForm = true;
    }

    public function closeQuoteForm()
    {
        $this->showQuoteForm = false;
        $this->reset(['name', 'email', 'message', 'selectedTestId']);
    }

    public function submitQuoteForm()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:500',
        ]);

        // Aquí puedes manejar el envío del formulario, por ejemplo, guardarlo en la base de datos o enviarlo por correo electrónico

        $this->closeQuoteForm();
        session()->flash('message', 'Solicitud de cotización enviada correctamente.');
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
                $searchTerm = strtolower($this->search);
                $query->where(function ($subQuery) use ($searchTerm) {
                    $subQuery->whereRaw('LOWER(variable) like ?', ["%{$searchTerm}%"])
                             ->orWhereRaw('LOWER(activity) like ?', ["%{$searchTerm}%"])
                             ->orWhereRaw('LOWER(`group`) like ?', ["%{$searchTerm}%"])
                             ->orWhereHas('lab', function ($labQuery) use ($searchTerm) {
                                 $labQuery->whereRaw('LOWER(name) like ?', ["%{$searchTerm}%"]);
                             });
                });
            })
            ->paginate(10);
    
        return view('livewire.lab-list', [
            'matrices' => $matrices,
            'tests' => $tests,
        ]);
    }
}