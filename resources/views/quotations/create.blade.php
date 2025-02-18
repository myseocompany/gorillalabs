@extends('layouts.app')

@section('content')
@include('labs.lab-details', ['lab'=> $lab])
<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Crear Cotización</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-200 text-red-800 p-3 rounded-md mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('quotations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block font-medium text-gray-700">Fecha de Cotización</label>
                <input type="date" name="quotation_date" class="w-full border rounded-md p-2" required>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Formas de Pago Aceptadas</label>
                @foreach($paymentMethods as $method)
                    <div class="flex items-center">
                        <input type="checkbox" name="payment_methods[]" value="{{ $method->id }}" class="mr-2">
                        <span>{{ $method->name }}</span>
                    </div>
                @endforeach
            </div>
            
            <div>
                <label class="block font-medium text-gray-700">Condición de Pago</label>
                <select name="payment_condition_id" class="w-full border rounded-md p-2" required>
                    @foreach($paymentConditions as $condition)
                        <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Vigencia</label>
                <select name="validity_period_id" class="w-full border rounded-md p-2" required>
                    @foreach($validityPeriods as $period)
                        <option value="{{ $period->id }}">{{ $period->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Acreditación ONAC</label>
                <select name="onac_accreditation" class="w-full border rounded-md p-2" required>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Acreditación IDEAM</label>
                <select name="ideam_accreditation" class="w-full border rounded-md p-2" required>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="col-span-2">
                <label class="block font-medium text-gray-700">Subir Archivo</label>
                <input type="file" name="file" class="w-full border rounded-md p-2" required>
            </div>
        </div>

        <div class="mt-6 text-right">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition">
                Crear Cotización
            </button>
        </div>
    </form>
</div>
@endsection
