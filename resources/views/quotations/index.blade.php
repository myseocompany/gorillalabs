@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Cotizaciones</h2>
        <a href="{{ route('quotations.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
            Nueva Cotización
        </a>
    </div>
    
    
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Usuario</th>
                    <th class="border border-gray-300 px-4 py-2">Fecha</th>
                    <th class="border border-gray-300 px-4 py-2">Métodos de Pago</th>
                    <th class="border border-gray-300 px-4 py-2">Condición de Pago</th>
                    <th class="border border-gray-300 px-4 py-2">Vigencia</th>
                    <th class="border border-gray-300 px-4 py-2">ONAC</th>
                    <th class="border border-gray-300 px-4 py-2">IDEAM</th>
                    <th class="border border-gray-300 px-4 py-2">Archivo</th>
                    <th class="border border-gray-300 px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotations as $quotation)
                    <tr class="text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ $quotation->lab->user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $quotation->quotation_date }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @foreach($quotation->paymentMethods as $method)
                                <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded">{{ $method->name }}</span>
                            @endforeach
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ $quotation->paymentCondition->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $quotation->validityPeriod->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $quotation->onac_accreditation ? 'Sí' : 'No' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $quotation->ideam_accreditation ? 'Sí' : 'No' }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if($quotation->file_url)
                                <a href="{{ $quotation->file_url }}" target="_blank" class="text-blue-500 underline">Ver Archivo</a>
                            @else
                                No adjunto
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('quotations.show', $quotation->id) }}" class="text-blue-500 underline">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
