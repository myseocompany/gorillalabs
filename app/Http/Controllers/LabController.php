<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lab;

class LabController extends Controller
{
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
