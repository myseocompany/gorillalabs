@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Lista de Laboratorios</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4 flex justify-between">
        <form method="GET" action="{{ route('labs.index') }}" class="flex space-x-2">
            <input type="text" name="search" class="border rounded-md p-2" placeholder="Buscar laboratorio..." value="{{ request('search') }}">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">Buscar</button>
        </form>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('labs.create') }}" class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition">
                Nuevo Laboratorio
            </a>
        @endif
    </div>

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2 text-left">Nombre</th>
                <th class="border px-4 py-2 text-left">NIT</th>
                <th class="border px-4 py-2 text-left">Ciudad</th>
                <th class="border px-4 py-2 text-left">Departamento</th>
                <th class="border px-4 py-2 text-center">Usuario Asignado</th>
                <th class="border px-4 py-2 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($labs as $lab)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $lab->name }}</td>
                    <td class="border px-4 py-2">{{ $lab->nit }}</td>
                    <td class="border px-4 py-2">{{ $lab->city }}</td>
                    <td class="border px-4 py-2">{{ $lab->department }}</td>
                    <td>
                        @if ($lab->user)
                            {{ $lab->user->email }}
                        @else
                            <a href="{{ route('labs.create-user-form',$lab) }}" 
                                class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                                Crear Usuario

                            </a>
                        @endif
                    </td>
                    
                    
                    <td class="border px-4 py-2 text-center space-x-2">
                        <a href="{{ route('labs.show', ['id'=>$lab->id]) }}" class="text-blue-600 hover:underline">Ver</a>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('labs.edit', ['id'=>$lab->id]) }}" class="text-yellow-600 hover:underline">Editar</a>
                            <form action="{{ route('labs.destroy', $lab) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('¿Seguro que quieres eliminar este laboratorio?')">Eliminar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $labs->links() }} <!-- Paginación -->
    </div>
</div>
@endsection
