<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lab;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LabController extends Controller
{
    /**
     * Muestra la lista de laboratorios (solo para administradores).
     */
    public function index(Request $request)
    {
        // Verificar que el usuario es administrador
        if (auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'No tienes permisos para acceder.');
        }

        // Búsqueda de laboratorios
        $search = $request->input('search');
        $labs = Lab::when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('nit', 'like', "%{$search}%")
                             ->orWhere('city', 'like', "%{$search}%")
                             ->orWhere('department', 'like', "%{$search}%");
            })
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('labs.index', compact('labs', 'search'));
    }
    public function assignUser(Lab $lab)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'No tienes permisos para acceder.');
        }

        $users = User::doesntHave('lab')->get(); // Solo usuarios sin laboratorio asignado

        return view('labs.assign-user', compact('lab', 'users'));
    }
    public function createUserForm(Request $request, $lid)
    {
        
        $lab = Lab::find($lid);
        // Extraer solo el primer email
        $emails = explode(';', $lab->email);
        $email = trim($emails[0]); // Tomar el primer email y quitar espacios

        // Remover el dígito de verificación del NIT
        // Remover los puntos y el dígito de verificación del NIT
        $nit = preg_replace('/\D/', '', $lab->nit); // Elimina puntos y caracteres no numéricos
        $nit = substr($nit, 0, -1); // Remueve el último dígito (DV)

        $name = $lab->name;


        return view('labs.create-user', compact('lab', 'email', 'nit','name'));
    }

    public function storeUser(Request $request)
    {
        try {
            // Validar los datos
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
            ]);

            // Si la validación pasa, continúa con la creación del usuario
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'laboratorio', // Asigna el rol adecuado
            ]);

            $lab = Lab::find($request->lab_id);
            // Asignar el usuario al laboratorio
            $lab->user_id = $user->id;
            $lab->save();

            return redirect()->route('labs.index')->with('success', 'Usuario creado y asignado al laboratorio correctamente.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Mostrar los errores en la respuesta
            return back()->withErrors($e->validator)->withInput();
        }
    }

    


    public function createUser(Request $request, Lab $lab)
    {
        $lab = Lab::find($request->lab_id);
        //dd($request);
        // Verificar si ya tiene un usuario asignado
        if ($lab->user_id) {
            return redirect()->route('labs.index')->with('error', 'Este laboratorio ya tiene un usuario asignado.');
        }

        // Crear el usuario
        $user = User::create([
            'name' => $lab->name,
            'email' => $lab->email,
            'password' => Hash::make($lab->nit),
            'role' => 'laboratorio', // Asigna el rol adecuado
        ]);

        // Asignar el usuario al laboratorio
        $lab->user_id = $user->id;
        $lab->save();

        return redirect()->route('labs.index')->with('success', 'Usuario creado y asignado al laboratorio correctamente.');
    }

    public function updateUser(Request $request, Lab $lab)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $lab->user_id = $request->user_id;
        $lab->save();

        return redirect()->route('labs.index')->with('success', 'Usuario asignado correctamente al laboratorio.');
    }


    /**
     * Mostrar el formulario de creación de laboratorio.
     */
    public function create()
    {
        return view('lab_profiles.create');
    }

    /**
     * Guardar el perfil de laboratorio en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'contact_person' => 'required|string|max:250',
            'contact_phone' => 'required|string|max:150',
            'contact_email' => 'required|email|max:250',
            'lab_name' => 'required|string|max:250',
            'specialization' => 'nullable|string|max:250',
            'license_number' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:150',
            'fax' => 'nullable|string|max:150',
            'website' => 'nullable|url|max:250',
        ]);

        LabProfile::create([
            'user_id' => Auth::id(),
            'contact_person' => $request->contact_person,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'lab_name' => $request->lab_name,
            'specialization' => $request->specialization,
            'license_number' => $request->license_number,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'website' => $request->website,
        ]);

        return redirect()->route('home')->with('success', 'Perfil de laboratorio creado correctamente.');
    }

    public function destroy($id)
    {
        $lab = Lab::findOrFail($id);
        $lab->delete();

        return redirect()->route('labs.index')->with('success', 'Laboratorio eliminado correctamente.');
    }


    /**
     * Muestra el formulario de edición de un laboratorio.
     */
    public function edit()
    {
        $lab = auth()->user()->lab;
    
        if (!$lab) {
            return redirect()->route('home')->with('error', 'No tienes un laboratorio asignado.');
        }
    
        return view('labs.edit', compact('lab'));
    }
    
    

    /**
     * Actualiza la información de un laboratorio.
     */
    public function update(Request $request)
    {
        $lab = auth()->user()->lab;

        if (!$lab) {
            return redirect()->route('home')->with('error', 'No tienes permiso para actualizar este laboratorio.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'nit' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'city' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'administrative_acts' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'resolution_compliance' => 'nullable|string|max:255',
            'attention_channels' => 'nullable|string',
            'accreditation_onac' => 'required|boolean',
            'accreditation_ideam' => 'required|boolean',
        ]);

        $lab->update($request->all());

        return redirect($request->input('previous_url', route('labs.show', $lab->id)))
        ->with('success', 'Laboratorio actualizado con éxito.');
    }



    public function show()
    {
        $lab = auth()->user()->lab;
    
        if (!$lab) {
            return redirect()->route('home')->with('error', 'No tienes un laboratorio asignado.');
        }
    
        return view('labs.show', compact('lab'));
    }
    

}
