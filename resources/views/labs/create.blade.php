@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Crear Nuevo Laboratorio</h2>

    <form action="{{ route('labs.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Nombre del Laboratorio</label>
            <input type="text" name="name" class="w-full border rounded-md p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">NIT</label>
            <input type="text" name="nit" class="w-full border rounded-md p-2" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition">
            Guardar Laboratorio
        </button>
    </form>
</div>
@endsection
