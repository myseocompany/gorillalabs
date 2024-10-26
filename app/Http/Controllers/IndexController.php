<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestActivityType; // Cambiado para reflejar el nombre correcto del modelo

class IndexController extends Controller
{
    public function index(Request $request)
    {
        // Obtener todos los tipos de actividad
        $testActivityTypes = TestActivityType::all(); 
        $testActivityType = $request->input('testActivityType'); // Obtener el valor por POST

        // Pasar los datos a la vista
        return view('welcome', compact('testActivityTypes'));
    }
}
