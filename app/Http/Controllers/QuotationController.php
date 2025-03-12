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
        

        if ($request->hasFile('file')) {
            // Guardar el archivo en storage/app/public/quotations
            $filePath = $request->file('file')->store('quotations', 'public');
    
            // Obtener la ruta absoluta en storage
            $storagePath = storage_path("app/public/{$filePath}");
    
            // Ruta donde queremos copiar el archivo en public_html
            $publicPath = base_path("../../public_html/storage/{$filePath}");
    
            // Asegurar que la carpeta de destino existe en public_html/storage/quotations
            $publicStoragePath = dirname($publicPath);
            if (!file_exists($publicStoragePath)) {
                mkdir($publicStoragePath, 0775, true);
            }
    
            // Copiar el archivo a public_html/storage/quotations
            if (copy($storagePath, $publicPath)) {
                $fileUrl = $filePath; // URL accesible desde el navegador
            } else {
                return redirect()->back()->with('error', 'Error al copiar el archivo a public_html.');
            }
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
        $user = auth()->user();

        // Si el usuario es administrador, ve todas las cotizaciones
        if ($user->role === 'admin') {
            $quotations = Quotation::all();
        } else {
            // Si es un laboratorio, solo ve las cotizaciones de su lab
            $lab = $user->lab;

            if (!$lab) {
                return redirect()->route('home')->with('error', 'No tienes un laboratorio asignado.');
            }

            $quotations = Quotation::where('lab_id', $lab->id)->get();
        }

        return view('quotations.index', compact('quotations'));
    }

    public function show($qid)
    {
        $user = auth()->user();

        
        $quotation = Quotation::find($qid);
    
        // Si el usuario es administrador, puede ver cualquier cotización
        if ($user->role === 'admin') {
            return view('quotations.show', compact('quotation'));
        }
    
        // Si es un laboratorio, verifica que la cotización pertenezca a su lab
        $lab = $user->lab;
    
        if (!$lab || $quotation->lab_id !== $lab->id) {
            return redirect()->route('quotations.index')->with('error', 'No tienes acceso a esta cotización.');
        }
    
        return view('quotations.show', compact('quotation'));
    }
    
}
