@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Editar Laboratorio</h2>

    @if (session()->has('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('labs.update', $lab) }}" method="POST">
        @csrf
        <input type="hidden" name="previous_url" value="{{ request('previous', url()->previous()) }}">

        <div class="grid grid-cols-3 gap-6">
            <!-- Columna 1 -->
            <div class="space-y-4">
                <div>
                    <label class="block font-medium text-gray-700">Nombre del Laboratorio</label>
                    <input type="text" name="name" class="w-full border rounded-md p-2" value="{{ $lab->name }}" required>
                </div>

                <div>
                    <label class="block font-medium text-gray-700">NIT</label>
                    <input type="text" name="nit" class="w-full border rounded-md p-2" value="{{ $lab->nit }}">
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Persona de Contacto</label>
                    <input type="text" name="contact_person" class="w-full border rounded-md p-2" value="{{ $lab->contact_person }}">
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Teléfono de Contacto</label>
                    <input type="text" name="contact_phone" class="w-full border rounded-md p-2" value="{{ $lab->contact_phone }}">
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Correo de Contacto</label>
                    <input type="email" name="contact_email" class="w-full border rounded-md p-2" value="{{ $lab->contact_email }}">
                </div>
            </div>

            <!-- Columna 2 -->
            <div class="space-y-4">
                <div>
                    <label class="block font-medium text-gray-700">Ciudad</label>
                    <input type="text" name="city" class="w-full border rounded-md p-2" value="{{ $lab->city }}">
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Departamento</label>
                    <input type="text" name="department" class="w-full border rounded-md p-2" value="{{ $lab->department }}">
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Dirección</label>
                    <input type="text" name="address" class="w-full border rounded-md p-2" value="{{ $lab->address }}">
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Teléfono</label>
                    <input type="text" name="phone" class="w-full border rounded-md p-2" value="{{ $lab->phone }}">
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Correo Electrónico</label>
                    <input type="email" name="email" class="w-full border rounded-md p-2" value="{{ $lab->email }}">
                </div>
            </div>

            <!-- Columna 3 -->
            <div class="space-y-4">
                <div>
                    <label class="block font-medium text-gray-700">Actos Administrativos</label>
                    <textarea name="administrative_acts" class="w-full border rounded-md p-2">{{ $lab->administrative_acts }}</textarea>
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Fecha de Inicio</label>
                    <input type="date" name="start_date" class="w-full border rounded-md p-2" value="{{ $lab->start_date }}">
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Fecha de Fin</label>
                    <input type="date" name="end_date" class="w-full border rounded-md p-2" value="{{ $lab->end_date }}">
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Cumplimiento de Resolución</label>
                    <input type="text" name="resolution_compliance" class="w-full border rounded-md p-2" value="{{ $lab->resolution_compliance }}">
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Canales de Atención</label>
                    <textarea name="attention_channels" class="w-full border rounded-md p-2">{{ $lab->attention_channels }}</textarea>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mt-6">
            <div>
                <label class="block font-medium text-gray-700">Acreditación ONAC</label>
                <select name="accreditation_onac" class="w-full border rounded-md p-2">
                    <option value="1" {{ $lab->accreditation_onac ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ !$lab->accreditation_onac ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Acreditación IDEAM</label>
                <select name="accreditation_ideam" class="w-full border rounded-md p-2">
                    <option value="1" {{ $lab->accreditation_ideam ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ !$lab->accreditation_ideam ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>

        <div class="mt-6 text-right">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition">
                Actualizar
            </button>
        </div>
    </form>
</div>


@endsection
