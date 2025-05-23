<!-- resources/views/menus/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-700 leading-tight">
            Crear Menú
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('menus.store') }}" method="POST">
                    @csrf

                    <!-- Descripció del menú -->
                    <div class="mb-4">
                        <label for="descripcio" class="block text-sm font-medium text-gray-700">Descripció del menú</label>
                        <textarea id="descripcio" name="descripcio" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('descripcio') }}</textarea>
                        @error('descripcio')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Plats Drag & Drop -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Assignació de Plats</label>

                        <div class="flex gap-6 mt-6">
                            <!-- Columna amb els 4 àpats -->
                            <div class="flex flex-col gap-4">
                                @foreach(['esmorzar', 'dinar', 'berenar', 'sopar'] as $tipus)
                                    <div class="container bg-gray-100" id="{{ $tipus }}" ondrop="drop(event)" ondragover="allowDrop(event)">
                                        <p class="text-gray-600 font-semibold capitalize">{{ $tipus }}</p>
                                        <!-- Aquí es col·locaran els plats -->
                                    </div>
                                @endforeach
                            </div>

                            <!-- Caixa gran Asignar -->
                            <div class="container bg-gray-50 h-full min-h-[800px]" id="asignar" ondrop="drop(event)" ondragover="allowDrop(event)">
                                <p class="text-gray-600 font-semibold">Asignar</p>

                                @foreach($plats as $plat)
                                    <div class="item" draggable="true" id="plat{{ $plat->id }}" ondragstart="drag(event)">
                                        {{ $plat->nom }}
                                        <input type="hidden" name="plats_disponibles[]" value="{{ $plat->id }}">
                                    </div>
                                @endforeach

                                @foreach(old('plats', []) as $index => $plat)
                                    <div class="item" draggable="true" id="oldItem{{ $index }}" ondragstart="drag(event)">
                                        {{ $plat }}
                                        <input type="hidden" name="plats_disponibles[]" value="{{ $plat }}">
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>



                    <!-- Assignar client -->
                    <div class="mb-4">
                        <label for="client_id" class="block text-sm font-medium text-gray-700">Assignar a un client</label>
                        <select id="client_id" name="client_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Cap client assignat</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Data de creació -->
                    <div class="mb-4">
                        <label for="created_at" class="block text-sm font-medium text-gray-700">Data de creació (opcional)</label>
                        <input type="date" id="created_at" name="created_at" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('created_at') }}">
                        @error('created_at')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Botó -->
                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Crear Menú</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        // Afegeix nous camps per plats
        document.getElementById('add-plat').addEventListener('click', function () {
            const platsFields = document.getElementById('plats-fields');
            const newField = document.createElement('div');
            newField.classList.add('plats-field', 'mb-2');
            newField.innerHTML = '<textarea name="plats[]" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>';
            platsFields.appendChild(newField);
        });

        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            const data = ev.dataTransfer.getData("text");
            const item = document.getElementById(data);

            // Evitem duplicats: no permetre duplicar dins d'altres contenidors
            if (!ev.target.classList.contains('container')) {
                ev.target = ev.target.closest('.container');
            }

            if (ev.target && !ev.target.contains(item)) {
                ev.target.appendChild(item);
            }
        }
    </script>


    <style>
        .container {
            width: 379px;
            min-height: 150px;
            border: 2px dashed #aaa;
            border-radius: 10px;
            padding: 10px;
        }
        .item {
            background-color: #3498db;
            color: white;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            cursor: grab;
        }
    </style>


</x-app-layout>
