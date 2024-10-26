<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-brand-color-2 text-white">
        <div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-r from-brand-color-2 to-gray-800">
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
    </body>
</html>
