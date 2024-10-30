@extends('layouts.app')

@section('content')
<div class="flex flex-col min-h-screen bg-gradient-to-r from-brand-color-2 to-gray-800">
    <!-- Navigation Menu -->
    <nav class="flex justify-end p-6">
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="text-white hover:text-gray-300 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
                <a href="{{ url('/') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Inicio</a>
                <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Iniciar sesión</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex flex-col items-center justify-center flex-grow">
        <div class="flex flex-col items-center text-center mb-8">
            <img src="/img/gorilla_lab_logo_blanco_verde.png" alt="" width="100" class="mb-4">
            <h1 class="text-3xl font-bold text-white mb-4">¿Qué test o muestreo ambiental buscas?</h1>
            <p class="text-lg text-gray-300">Encuentra el laboratorio adecuado para tus necesidades.</p>
        </div>
        <div class="w-full max-w-lg">
            <form action="{{ route('result') }}" method="GET" class="relative">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Buscar..."
                    class="w-full px-4 py-3 border border-gray-400 rounded-full shadow-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-color-1"
                />
                <button type="submit" class="absolute right-2 top-2 p-2 bg-brand-color-1 text-white rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
                <div class="mb-6">
                    <label for="testActivityType" class="block text-lg font-semibold text-brand-color-2 mb-4">Tipo de servicio</label>
                    <select 
                        id="testActivityType" name="testActivityType" 
                        wire:model="testActivityType" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-color-1"
                    >
                        <option onchange="submit()" value="">Seleccione un tipo de servicio</option> <!-- Asegúrate de tener value="" -->
                        @foreach ($testActivityTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection