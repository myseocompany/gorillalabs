<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TestMatrix;
use App\Models\TestActivity;
use App\Models\TestActivityType;
use App\Models\Test;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Municipality;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class LabList extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedMatrix = null;
    public $testActivityType = null;
    public $testActivity = null;
    public $selectedDepartment = null;
    public $selectedMunicipality = null;
    public $municipalities = []; // Municipios dinámicos
    public $showQuoteForm = false; // Estado del formulario de cotización
    public $selectedTestId = null; // ID del test seleccionado
    public $name = '';
    public $phone = '';
    public $email = '';
    public $message = '';

    protected $queryString = ['search', 'selectedMatrix', 'testActivityType', 'testActivity', 'selectedDepartment', 'selectedMunicipality'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
        $this->testActivityType = request()->query('testActivityType', $this->testActivityType);
    }

    public function updatedSelectedDepartment($departmentId)
    {
        $this->municipalities = $departmentId
            ? Municipality::where('department_id', $departmentId)->get()
            : collect();
        $this->selectedMunicipality = null;
        $this->resetPage();
    }

    public function render()
    {
        $activityTypes = TestActivityType::all();
        $activities = $this->testActivityType
            ? TestActivity::where('type_id', $this->testActivityType)->get()
            : TestActivity::all();
        $matrices = TestMatrix::all();
        $departments = Department::all();

        $tests = Test::with('lab')
            ->where('accreditation_status', 'Activa')
            ->when($this->testActivityType, fn($query) => $query->where('activity_type_id', $this->testActivityType))
            ->when($this->testActivity, fn($query) => $query->where('activity_id', $this->testActivity))
            ->when($this->selectedMatrix, fn($query) => $query->where('matrix', 'like', '%' . $this->selectedMatrix . '%'))
            ->when($this->search, fn($query) => $query->where(function ($subQuery) {
                $searchTerm = strtolower($this->search);
                $subQuery->whereRaw('LOWER(variable) like ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(matrix) like ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(`group`) like ?', ["%{$searchTerm}%"])
                    ->orWhereHas('lab', fn($labQuery) => $labQuery->whereRaw('LOWER(name) like ?', ["%{$searchTerm}%"]));
            }))
            ->when($this->selectedDepartment, fn($query) => $query->whereHas('lab', fn($labQuery) => $labQuery->where('department_id', $this->selectedDepartment)))
            ->when($this->selectedMunicipality, fn($query) => $query->whereHas('lab', fn($labQuery) => $labQuery->where('municipality_id', $this->selectedMunicipality)))
            ->paginate(10);

        return view('livewire.lab-list', [
            'activityTypes' => $activityTypes,
            'activities' => $activities,
            'matrices' => $matrices,
            'departments' => $departments,
            'municipalities' => $this->municipalities,
            'tests' => $tests,
        ]);
    }

    public function openQuoteForm($testId)
    {
        $this->selectedTestId = $testId;
        $this->showQuoteForm = true;
    }

    public function closeQuoteForm()
    {
        $this->showQuoteForm = false;
    }


    public function submitQuoteForm()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:500',
        ]);

        // Obtener todos los datos del test asociado al selectedTestId
        $test = Test::with('lab')->find($this->selectedTestId);

        if (!$test) {
            // Manejar el caso en que no se encuentre el test
            Log::error('Test no encontrado', ['test_id' => $this->selectedTestId]);
            return;
        }

        // Crear el cliente en la base de datos local
        $customer = Customer::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'message' => $this->message,
            'test_id' => $this->selectedTestId,
        ]);

        // Datos a enviar al CRM
        $crmData = [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'notes' => $this->message,
            'analysis' => $test->name,
            'samples' => $test->variable,
        ];

        // dd($crmData);

        // Enviar los datos al CRM
        $response = Http::get('https://gorillalab.aricrm.co/api/customers/save', $crmData);

        if ($response->successful()) {
            // Manejar la respuesta exitosa del CRM si es necesario
            Log::info('Solicitud exitosa al CRM', ['response' => $response->json()]);
        } else {
            // Manejar el error de la solicitud al CRM si es necesario
            Log::error('Error en la solicitud al CRM', ['response' => $response->json()]);
        }

        $this->closeQuoteForm();
    }

    public function clearTestActivityType()
    {
        $this->testActivityType = null;
        $this->testActivity = null; // También limpiar la actividad seleccionada
        $this->resetPage();
    }

    public function clearTestActivity()
    {
        $this->testActivity = null;
        $this->resetPage();
    }

    public function clearSelectedMatrix()
    {
        $this->selectedMatrix = null;
        $this->resetPage();
    }

    public function clearSelectedDepartment()
    {
        $this->selectedDepartment = null;
        $this->selectedMunicipality = null; // Limpiar el municipio también
        $this->municipalities = collect(); // Restablecer la lista de municipios
        $this->resetPage();
    }

    public function clearSelectedMunicipality()
    {
        $this->selectedMunicipality = null;
        $this->resetPage();
    }
}
