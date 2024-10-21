<div>
    <!-- Header -->
    <header class="bg-brand-color-2 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4 w-full">
                <div class="text-xl font-bold"><a href="{{ route('home') }}">Gorilla Labs</a></div>
                <div class="flex-1">
                    <input 
                        wire:model.live="search"
                        type="text" 
                        placeholder="Buscar..." 
                        class="w-full border border-gray-300 rounded-full px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-color-1"
                    />
                </div>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <div class="container mx-auto mt-8 flex">
        <!-- Sidebar -->
        <aside class="w-1/4 p-4 hidden lg:block">
            <h2 class="text-lg font-semibold text-brand-color-2 mb-4">Matriz</h2>
            <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
                <ul class="mt-2 space-y-2">
                    @foreach ($matrices as $matrix)
                        <li>
                            <label>
                                <input type="radio"
                                       name="matrix" 
                                       wire:click="selectMatrix('{{ $matrix->name }}')"
                                       @if($selectedMatrix === $matrix->name) checked @endif
                                       class="mr-2">
                                {{ $matrix->name }}
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- Main section -->
        <main class="flex-1 p-4">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-brand-color-2">Resultados para: "{{ $search }}"</h1>
                <p class="text-gray-600">{{ $tests->total() }} test encontrados.</p>
            </div>

            <div class="space-y-4">
                @forelse ($tests as $test)
                    <!-- Test Card -->
                    <div class="bg-white rounded-lg shadow-sm p-4 flex items-start justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-brand-color-2">
                                {{ $test->matrix }} - {{ $test->variable }} ({{ $test->activity }}) - {{ $test->lab->name }}
                            </h3>
                            <p class="text-gray-600">
                                <strong>Grupo:</strong> {{ $test->group }} <br>
                                <strong>Técnica:</strong> {{ $test->technique }} <br>
                                <strong>Componente:</strong> {{ $test->component }}
                            </p>
                        </div>
                        <button class="bg-brand-color-1 text-white py-2 px-4 rounded-full">Cotizar</button>
                    </div>
                @empty
                    <p class="text-gray-600">No se encontraron laboratorios que coincidan con la búsqueda.</p>
                @endforelse
            </div>

            <!-- Pagination Links -->
            <div class="mt-8">
                {{ $tests->links() }}
            </div>
        </main>
    </div>
</div>
