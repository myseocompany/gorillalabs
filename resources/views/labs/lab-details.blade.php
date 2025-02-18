<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Detalles del Laboratorio</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-3 gap-6">
        <!-- Columna 1 -->
        <div class="space-y-4">
            <div>
                <label class="block font-medium text-gray-700">Nombre del Laboratorio</label>
                <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $lab->name }}</p>
            </div>

            <div>
                <label class="block font-medium text-gray-700">NIT</label>
                <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $lab->nit }}</p>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Persona de Contacto</label>
                <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $lab->contact_person }}</p>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Teléfono de Contacto</label>
                <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $lab->contact_phone }}</p>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Correo de Contacto</label>
                <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $lab->contact_email }}</p>
            </div>
        </div>

        <!-- Columna 2 -->
        <div class="space-y-4">
            <div>
                <label class="block font-medium text-gray-700">Ciudad</label>
                <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $lab->city }}</p>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Departamento</label>
                <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $lab->department }}</p>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Dirección</label>
                <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $lab->address }}</p>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Teléfono</label>
                <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $lab->phone }}</p>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Correo Electrónico</label>
                <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $lab->email }}</p>
            </div>
        </div>

        <!-- Columna 3 -->
        <div class="space-y-4">
            <div>
                <label class="block font-medium text-gray-700">Actos Administrativos</label>
                <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $lab->administrative_acts }}</p>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Fecha de Inicio</label>
                <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $lab->start_date }}</p>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Fecha de Fin</label>
                <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $lab->end_date }}</p>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Cumplimiento de Resolución</label>
                <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $lab->resolution_compliance }}</p>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Canales de Atención</label>
                <p class="text-gray-900 p-2 bg-gray-200 rounded-md">{{ $lab->attention_channels }}</p>
            </div>
        </div>
    </div>


    

    <div class="mt-6 flex justify-end space-x-4">
       

        <a href="{{ route('labs.edit', ['lab' => $lab->id, 'previous' => url()->full()]) }}" 
            class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition">
             Editar
         </a>
         
        
    </div>
    
</div>