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

                    <!-- Plats -->
                    <div class="mb-4" id="plats-container">
                        <label class="block text-sm font-medium text-gray-700">Plats</label>
                        <div id="plats-fields">
                            <div class="plats-field mb-2">
                                <textarea name="plats[]" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('plats.0') }}</textarea>
                            </div>
                        </div>
                        <button type="button" id="add-plat" class="mt-2 text-blue-600 hover:text-blue-700">Afegir un altre plat</button>
                        @error('plats')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
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
    </script>
</x-app-layout>
