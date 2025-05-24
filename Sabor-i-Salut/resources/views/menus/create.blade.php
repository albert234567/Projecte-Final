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
                        <label for="descripcio" class="block text-sm font-medium text-gray-700">Títol del menú</label>
                        <textarea id="descripcio" name="descripcio" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('descripcio') }}</textarea>
                        @error('descripcio')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                        <br>
                    <label class="block text-sm font-medium text-gray-700">Assignació de Plats</label>

                    <!-- Plats Drag & Drop -->
                    <div class="mb-4">

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

<!-- Selector intoleràncies dins Assignar -->
<div class="mb-4">
    <p class="font-medium text-gray-700 mb-2">Filtra per intoleràncies:</p>
    <label><input type="checkbox" name="intolerancies[]" value="Sense lactosa" class="filter-intolerancia"> Sense lactosa</label><br>
    <label><input type="checkbox" name="intolerancies[]" value="Sense gluten" class="filter-intolerancia"> Sense gluten</label><br>
    <label><input type="checkbox" name="intolerancies[]" value="Sense fruits secs" class="filter-intolerancia"> Sense fruits secs</label>
</div>

<div class="mb-4">
    <label><input type="checkbox" id="filter-vega" name="vega" value="1"> Vegà</label>
</div>


<div id="plats-container">
    <!-- Aquí carreguem els plats filtrats -->
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const platsContainer = document.getElementById('plats-container');

    function carregarPlats() {
        // Obtenim totes les intoleràncies marcades
        const checkboxes = document.querySelectorAll('.filter-intolerancia:checked');
        const intolerancies = Array.from(checkboxes).map(cb => cb.value);

        // Vegà
        const vega = document.getElementById('filter-vega').checked ? '1' : '';

        const params = new URLSearchParams();

        intolerancies.forEach(intol => params.append('intolerancies[]', intol));
        if (vega) params.append('vega', vega);

        fetch(`{{ route('plats.filter') }}?${params.toString()}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(plats => {
            platsContainer.innerHTML = '';

            if(plats.length === 0) {
                platsContainer.innerHTML = '<p class="text-gray-500">No s\'han trobat plats amb aquest filtre.</p>';
                return;
            }

            plats.forEach(plat => {
                const div = document.createElement('div');
                div.className = 'item p-3 border border-gray-600 rounded mb-3 bg-gray-800 shadow-sm';
                div.draggable = true;
                div.id = `plat${plat.id}`;
                div.ondragstart = drag;

                div.innerHTML = `
                    <h4 class="text-md font-semibold text-white">${plat.nom}</h4>
                    <p class="text-sm text-white mt-1">
                        ${plat.tipus ? plat.tipus.charAt(0).toUpperCase() + plat.tipus.slice(1) : 'No especificat'} |
                        <strong>Vegà:</strong> ${plat.vega ? 'Sí' : 'No'} |
                        <strong>Intoleràncies:</strong> ${plat.intolerancies && plat.intolerancies.length ? plat.intolerancies.join(', ') : 'Cap'}
                    </p>
                    <input type="hidden" name="plats_disponibles[]" value="${plat.id}">
                `;

                platsContainer.appendChild(div);
            });
        })
        .catch(err => {
            platsContainer.innerHTML = '<p class="text-red-500">Error carregant plats.</p>';
            console.error(err);
        });
    }

    // Assignar l'event als checkboxes i al checkbox vegà
    document.querySelectorAll('.filter-intolerancia').forEach(el => {
        el.addEventListener('change', carregarPlats);
    });
    document.getElementById('filter-vega').addEventListener('change', carregarPlats);

    carregarPlats();
});
</script>
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

    // Assegura que el drop es fa sobre un contenidor
    let container = ev.target.closest('.container');
    if (!container || container.contains(item)) return;

    container.appendChild(item);

    // Netegem inputs antics si existeixen
    const oldInput = item.querySelector('input[type="hidden"]');
    if (oldInput) oldInput.remove();

    // Afegim un input hidden amb el nom plats[tipus][]
    const tipus = container.id;
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = `plats[${tipus}][]`;
    hiddenInput.value = item.id.replace('plat', '');
    item.appendChild(hiddenInput);
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

        #asignar {
            max-height: 649px; /* pots ajustar segons el teu disseny */
            overflow-y: auto;
        }

    </style>


</x-app-layout>
