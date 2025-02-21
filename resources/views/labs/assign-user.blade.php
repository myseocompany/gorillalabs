@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Asignar Usuario al Laboratorio: {{ $lab->name }}</h2>

    <form action="{{ route('labs.update-user') }}" method="POST">
        @csrf
        <input type="hidden" name="lab_id" value="{{ $lab->id }}">
    
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Seleccionar Usuario</label>
            <select name="user_id" class="w-full border rounded-md p-2" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition">
            Asignar Usuario
        </button>
    </form>
    
</div>
@endsection
