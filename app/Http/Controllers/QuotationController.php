<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\PaymentMethod;
use App\Models\PaymentCondition;
use App\Models\ValidityPeriod;
use Illuminate\Support\Facades\Auth;

class QuotationController extends Controller
{
    /**
     * Mostrar el formulario de creación de cotización.
     */
    public function create()
    {
        $lab = auth()->user()->lab;

        if (!$lab) {
            return redirect()->route('home')->with('error', 'No tienes un laboratorio asignado.');
        }

        return view('quotations.create', [
            'paymentMethods' => PaymentMethod::all(),
            'paymentConditions' => PaymentCondition::all(),
            'validityPeriods' => ValidityPeriod::all(),
            'lab' => $lab
        ]);
    }

    /**
     * Guardar la cotización en la base de datos.
     */
    public function store(Request $request)
    {
        $lab = auth()->user()->lab;

        if (!$lab) {
            return redirect()->route('home')->with('error', 'No tienes un laboratorio asignado.');
        }

        

        $request->validate([
            'quotation_date' => 'required|date',
            'payment_methods' => 'required|array|min:1', // Mínimo 1 método de pago seleccionado
            'payment_condition_id' => 'required|exists:payment_conditions,id',
            'validity_period_id' => 'required|exists:validity_periods,id',
            'onac_accreditation' => 'required|boolean',
            'ideam_accreditation' => 'required|boolean',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:2048', // Archivo obligatorio, solo PDFs y Docs
        ], [
            'payment_methods.required' => 'Debes seleccionar al menos un método de pago.',
            'file.required' => 'Debes subir un archivo de cotización.',
            'file.mimes' => 'El archivo debe ser PDF o documento de Excel o Word.',
            'file.max' => 'El archivo no debe superar los 2MB.',
        ]);
        

        $fileUrl = null;
        if ($request->hasFile('file')) {
            $fileUrl = $request->file('file')->store('quotations', 'public');
        }

        $quotation = Quotation::create([
            'lab_id' => $lab->id,
            'quotation_date' => $request->quotation_date,
            'payment_condition_id' => $request->payment_condition_id,
            'validity_period_id' => $request->validity_period_id,
            'onac_accreditation' => $request->onac_accreditation,
            'ideam_accreditation' => $request->ideam_accreditation,
            'file_url' => $fileUrl
        ]);

        $quotation->paymentMethods()->attach($request->payment_methods);

        return redirect()->route('quotations.index')->with('success', 'Cotización creada correctamente.');
    }


    /**
     * Mostrar la lista de cotizaciones del laboratorio del usuario autenticado.
     */
    public function index()
    {
        $lab = auth()->user()->lab;

        if (!$lab) {
            return redirect()->route('home')->with('error', 'No tienes un laboratorio asignado.');
        }

        $quotations = Quotation::where('lab_id', $lab->id)->get();

        return view('quotations.index', compact('quotations'));
    }
    public function show(Quotation $quotation)
    {
        $lab = Auth::user()->lab;
        if (!$lab || $quotation->lab_id !== $lab->id) {
            return redirect()->route('quotations.index')->with('error', 'No tienes acceso a esta cotización.');
        }

        return view('quotations.show', compact('quotation'));
    }
}
