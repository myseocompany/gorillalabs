@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">

    @if ($errors->any())
        <div class="bg-red-200 text-red-800 p-3 rounded-md mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2 class="text-2xl font-bold mb-6">Crear Usuario para el Laboratorio: {{ $lab->name }}</h2>

    <form action="{{ route('labs.store-user') }}" method="POST">
        @csrf
        <!-- Campo Nombre -->
        <input type="hidden" name="lab_id" value="{{$lab->id}}">
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $name) }}" 
                class="w-full border rounded-md p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Correo Electrónico</label>
            <input type="email" name="email" value="{{ old('email', $email) }}" 
                class="w-full border rounded-md p-2" required>
                
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Contraseña (NIT sin DV)</label>
            <input type="text" name="password" value="{{ old('password', $nit) }}" 
                class="w-full border rounded-md p-2" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition">
            Crear Usuario
        </button>
    </form>
</div>
@endsection
