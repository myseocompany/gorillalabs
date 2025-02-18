@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Detalle de Cotización</h2>

    <div class="grid grid-cols-2 gap-6">
        <div>
            <label class="block font-medium text-gray-700">Fecha de Cotización</label>
            <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $quotation->quotation_date }}</p>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Métodos de Pago</label>
            <p class="text-gray-900 p-2 bg-gray-200 rounded-md">
                @foreach($quotation->paymentMethods as $method)
                    <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded">{{ $method->name }}</span>
                @endforeach
            </p>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Condición de Pago</label>
            <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $quotation->paymentCondition->name }}</p>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Vigencia</label>
            <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $quotation->validityPeriod->name }}</p>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Acreditación ONAC</label>
            <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $quotation->onac_accreditation ? 'Sí' : 'No' }}</p>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Acreditación IDEAM</label>
            <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $quotation->ideam_accreditation ? 'Sí' : 'No' }}</p>
        </div>
    </div>

    <div class="mt-6">
        <label class="block font-medium text-gray-700">Archivo Adjunto</label>
        @if($quotation->file_url)
            <a href="{{ $quotation->file_url }}" target="_blank" class="text-blue-500 underline">Ver Archivo</a>
        @else
            <p class="text-gray-500">No adjunto</p>
        @endif
    </div>

    <div class="mt-6 text-right">
        <a href="{{ route('quotations.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-gray-600 transition">
            Volver
        </a>
    </div>
</div>
@endsection
