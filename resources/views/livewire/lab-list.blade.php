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
                        class="w-full border border-gray-300 rounded-full px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-color-1" />
                </div>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <div class="container mx-auto mt-8 flex">
        <!-- Sidebar -->
        <aside class="w-1/4 p-4 hidden lg:block">
            <h2 class="text-lg font-semibold text-brand-color-2 mb-4">Departamento</h2>
            <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
                <!-- Ejemplo de departamentos estáticos -->
                <ul class="mt-2 space-y-2">
                    <li>
                        <label>
                            <input type="radio"
                                name="location"
                                class="mr-2">
                            Caldas
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="radio"
                                name="location"
                                class="mr-2">
                            Pereira
                        </label>
                    </li>
                </ul>
            </div>
            <h2 class="text-lg font-semibold text-brand-color-2 mb-4">Tipo de servicio</h2>
            <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
                <select wire:model="selectedServiceType"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-color-1">
                    <option value="">Seleccione un tipo de servicio</option>
                    @foreach ($testActivities as $activity)
                    <option value="{{ $activity->name }}">{{ $activity->name }}</option>
                    @endforeach
                </select>
            </div>

            <h2 class="text-lg font-semibold text-brand-color-2 mb-4">Matriz</h2>
            <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
                <ul class="mt-2 space-y-2">
                    @foreach ($matrices as $matrix)
                    <li>
                        <label>
                            <input type="radio"
                                name="matrix"
                                wire:click="selectMatrix('{{ $matrix->name }}')"
                                @if($selectedMatrix===$matrix->name) checked @endif
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
                @if(!empty($selectedTypes))
                <p class="text-gray-600">Actividades seleccionadas: {{ implode(', ', $selectedTypes) }}</p>
                @endif
            </div>

            <div class="space-y-4">
                @forelse ($tests as $test)
                <!-- Test Card -->
                <div class="bg-white rounded-lg shadow-sm p-4 flex items-start justify-between">
                    <div>
                        <h6 class="text-slate-400">{{ Str::title($test->lab->name) }}</h6>
                        <h3 class="text-lg font-semibold text-brand-color-1">
                            {{ $test->matrix }} - {{ $test->variable }} ({{ $test->activity }})
                        </h3>
                        <p class="text-gray-600">
                            <strong>Grupo:</strong> {{ $test->group }} <br>
                            <strong>Técnica:</strong> {{ $test->technique }} <br>
                            <strong>Componente:</strong> {{ $test->component }}
                        </p>
                    </div>
                    <button wire:click="openQuoteForm({{ $test->id }})" class="bg-brand-color-1 text-white py-2 px-4 rounded-full">Cotizar</button>
                </div>
                @empty
                <p class="text-gray-600">No se encontraron laboratorios que coincidan con la búsqueda.</p>
                @endforelse
            </div>

            <!-- Pagination Links -->
            <div class="mt-8">
                {{ $tests->links() }}
            </div>

            <!-- Quote Form Modal -->
            @if($showQuoteForm)
            <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-8 rounded-lg shadow-lg w-1/2">
                    <h2 class="text-2xl font-bold mb-4">Cotizar</h2>
                    <form wire:submit.prevent="submitQuoteForm">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Nombre</label>
                            <input type="text" id="name" wire:model="name" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700">Teléfono</label>
                            <input type="text" id="phone" wire:model="phone" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Correo Electrónico</label>
                            <input type="email" id="email" wire:model="email" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700">Mensaje</label>
                            <textarea id="message" wire:model="message" class="w-full border border-gray-300 rounded-lg px-4 py-2"></textarea>
                            @error('message') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex justify-end">
                            <button type="button" wire:click="closeQuoteForm" class="bg-gray-500 text-white py-2 px-4 rounded-lg mr-2">Cancelar</button>
                            <button type="submit" class="bg-brand-color-1 text-white py-2 px-4 rounded-lg">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
    </div>
    </main>
</div>
</div>