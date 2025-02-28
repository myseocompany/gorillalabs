@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Crear Laboratorio</h2>

    @if (session()->has('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('labs.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block font-medium text-gray-700">Nombre del Laboratorio</label>
                <input type="text" name="name" class="w-full border rounded-md p-2" required>
            </div>

            <div>
                <label class="block font-medium text-gray-700">NIT</label>
                <input type="text" name="nit" class="w-full border rounded-md p-2" required>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Correo Electrónico</label>
                <input type="email" name="email" class="w-full border rounded-md p-2" required>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Persona de Contacto</label>
                <input type="text" name="contact_person" class="w-full border rounded-md p-2" required>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Teléfono de Contacto</label>
                <input type="text" name="contact_phone" class="w-full border rounded-md p-2" required>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Ciudad</label>
                <input type="text" name="city" class="w-full border rounded-md p-2">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Departamento</label>
                <input type="text" name="department" class="w-full border rounded-md p-2">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Dirección</label>
                <input type="text" name="address" class="w-full border rounded-md p-2">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Teléfono</label>
                <input type="text" name="phone" class="w-full border rounded-md p-2">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Acreditación ONAC</label>
                <select name="accreditation_onac" class="w-full border rounded-md p-2">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Acreditación IDEAM</label>
                <select name="accreditation_ideam" class="w-full border rounded-md p-2">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>

        <div class="mt-6 text-right">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition">
                Crear Laboratorio
            </button>
        </div>
    </form>
</div>
@endsection
