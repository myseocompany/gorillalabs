<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabProfile;
use Illuminate\Support\Facades\Auth;

class LabProfileController extends Controller
{
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
}
