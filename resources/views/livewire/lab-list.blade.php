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

    <!-- Filtros horizontales -->
    <div class="container mx-auto mt-4">
        <div x-data="{ open: false }" class="bg-white p-4 rounded-lg shadow-sm">
            <!-- Botón para desplegar filtros en vista de teléfono -->
            <button @click="open = !open" class="w-full md:hidden bg-brand-color-1 text-white px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
                Filtros
            </button>
            <!-- Contenedor de filtros -->
            <div :class="{'hidden': !open, 'block': open}" class="mt-4 flex flex-col space-y-4 md:flex md:flex-row md:space-y-0 md:space-x-4 md:block">
                <!-- Filtro de Tipo de Actividad -->
                <div class="w-full md:w-auto">
                    <label for="activityType" class="block text-sm font-medium text-gray-700">Tipo de Actividad</label>
                    <select
                        id="testActivityType" name="testActivityType"
                        wire:model.live="testActivityType"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-color-1"
                        data-live-search="true">
                        <option value="">Seleccione un tipo de actividad</option>
                        @foreach ($activityTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro de Actividad -->
                <div class="w-full md:w-auto">
                    <label for="activity" class="block text-sm font-medium text-gray-700">Actividad</label>
                    <select
                        id="testActivity" name="testActivity"
                        wire:model.live="testActivity"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-color-1"
                        data-live-search="true"
                        {{ is_null($testActivityType) ? 'disabled' : '' }}>
                        <option value="">Seleccione una actividad</option>
                        @foreach ($activities as $activity)
                        <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro de Matriz -->
                <div class="w-full md:w-auto">
                    <label for="matrix" class="block text-sm font-medium text-gray-700">Matriz</label>
                    <select
                        id="matrix"
                        name="matrix"
                        wire:model.live="selectedMatrix"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-color-1">
                        <option value="">Seleccione una matriz</option>
                        @foreach ($matrices as $matrix)
                        <option value="{{ $matrix->name }}">{{ $matrix->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Select de Departamentos -->
                <div class="w-full md:w-auto">
                    <label for="department" class="block text-sm font-medium text-gray-700">Departamento</label>
                    <select id="department"
                        wire:model.live="selectedDepartment"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-color-1">
                        <option value="">Seleccione un departamento</option>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Select de Municipios -->
                <div class="w-full md:w-auto">
                    <label for="municipality" class="block text-sm font-medium text-gray-700">Municipio</label>
                    <select id="municipality"
                        wire:model.live="selectedMunicipality"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-color-1" {{ is_null($selectedDepartment) ? 'disabled' : '' }}>
                        <option value="">Seleccione un municipio</option>
                        @foreach($municipalities as $municipality)
                        <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="container mx-auto mt-8">
        <main class="flex-1 p-4">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-brand-color-2">Resultados para: "{{ $search }}"</h1>
                <p class="text-gray-600">{{ $tests->total() }} test encontrados.</p>
                <!-- Mostrar etiquetas de los filtros seleccionados -->
                <div class="flex flex-wrap space-x-2 mt-2">
                    @if($testActivityType)
                    <span class="bg-brand-color-1 text-white px-3 py-1 rounded-full text-sm flex items-center">
                        Tipo de Actividad: {{ optional($activityTypes->firstWhere('id', $testActivityType))->name }}
                        <button wire:click="clearTestActivityType" class="ml-2 text-white text-xs focus:outline-none">✕</button>
                    </span>
                    @endif
                    @if($testActivity)
                    <span class="bg-brand-color-1 text-white px-3 py-1 rounded-full text-sm flex items-center">
                        Actividad: {{ optional($activities->firstWhere('id', $testActivity))->name }}
                        <button wire:click="clearTestActivity" class="ml-2 text-white text-xs focus:outline-none">✕</button>
                    </span>
                    @endif
                    @if($selectedMatrix)
                    <span class="bg-brand-color-1 text-white px-3 py-1 rounded-full text-sm flex items-center">
                        Matriz: {{ $selectedMatrix }}
                        <button wire:click="clearSelectedMatrix" class="ml-2 text-white text-xs focus:outline-none">✕</button>
                    </span>
                    @endif
                    @if($selectedDepartment)
                    <span class="bg-brand-color-1 text-white px-3 py-1 rounded-full text-sm flex items-center">
                        Departamento: {{ optional($departments->firstWhere('id', $selectedDepartment))->name }}
                        <button wire:click="clearSelectedDepartment" class="ml-2 text-white text-xs focus:outline-none">✕</button>
                    </span>
                    @endif
                    @if($selectedMunicipality)
                    <span class="bg-brand-color-1 text-white px-3 py-1 rounded-full text-sm flex items-center">
                        Municipio: {{ optional($municipalities->firstWhere('id', $selectedMunicipality))->name }}
                        <button wire:click="clearSelectedMunicipality" class="ml-2 text-white text-xs focus:outline-none">✕</button>
                    </span>
                    @endif
                </div>
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
                        <div>

                            <p>
                                <strong>Matriz:</strong> {{ $test->matrix }} <br>
                                @if(isset($test->department))
                                {{ $test->department->name }},
                                @endif
                                @if(isset($test->municipality))
                                {{ $test->municipality->name }}
                                @endif
                            </p>
                            <h4 class="text-gray-600">
                                {{ $test->group }},
                                {{ $test->technique }},
                                {{ $test->component }}
                            </h4>
                        </div>
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
                <div class="bg-white p-8 rounded-lg shadow-lg w-full md:w-1/2 mx-4 md:mx-auto">
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
                        <div class="mt-4">
                            <a href="{{ route('privacy-policy') }}" class="text-green-600 hover:underline">Conoce nuestras Política de Privacidad</a>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" wire:click="closeQuoteForm" class="bg-gray-500 text-white py-2 px-4 rounded-lg mr-2">Cancelar</button>
                            <button type="submit" class="bg-brand-color-1 text-white py-2 px-4 rounded-lg">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
            <!-- Footer -->
            <footer class="bg-brand-color-2 text-white py-4 mt-8">
                <div class="container mx-auto text-center">
                    <a href="{{ route('privacy-policy') }}" class="text-white hover:underline">Política de Privacidad</a>
                </div>
            </footer>
    </div>