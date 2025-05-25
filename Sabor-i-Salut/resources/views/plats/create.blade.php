<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-700 leading-tight">
            Crear Plat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <form action="{{ route('plats.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="nom" class="block text-sm font-medium text-gray-700">Nom del plat</label>
                        <input type="text" name="nom" id="nom" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('nom') }}" required>
                        @error('nom')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="descripcio" class="block text-sm font-medium text-gray-700">Descripció i mides</label>
                        <textarea name="descripcio" id="descripcio" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('descripcio') }}</textarea>
                        @error('descripcio')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="quantitat" class="block text-sm font-medium text-gray-700">Quantitat (ex: 200g)</label>
                        <input type="text" name="quantitat" id="quantitat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('quantitat') }}">
                        @error('quantitat')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tipus" class="block text-sm font-medium text-gray-700">Tipus</label>
                        <select name="tipus" id="tipus" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Selecciona tipus</option>
                            <option value="esmorzar" {{ old('tipus', $plat->tipus ?? '') == 'esmorzar' ? 'selected' : '' }}>Esmorzar</option>
                            <option value="dinar" {{ old('tipus', $plat->tipus ?? '') == 'dinar' ? 'selected' : '' }}>Dinar</option>
                            <option value="berenar" {{ old('tipus', $plat->tipus ?? '') == 'berenar' ? 'selected' : '' }}>Berenar</option>
                            <option value="sopar" {{ old('tipus', $plat->tipus ?? '') == 'sopar' ? 'selected' : '' }}>Sopar</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="vega" value="1" {{ old('vega', $plat->vega ?? false) ? 'checked' : '' }} class="form-checkbox">
                            <span class="ml-2">Vegà</span>
                        </label>
                    </div>

                    <div class="mb-4">
                        <span class="block text-sm font-medium text-gray-700 mb-1">Intoleràncies</span>
                        @php
                            $intoleranciesOptions = ['Sense lactosa' => 'Sense lactosa', 'Sense gluten' => 'Sense gluten', 'Sense fruits secs' => 'Sense fruits secs'];
                            $selectedIntolerancies = old('intolerancies', $plat->intolerancies ?? []);
                        @endphp
                        @foreach ($intoleranciesOptions as $key => $label)
                            <label class="inline-flex items-center mr-4">
                                <input type="checkbox" name="intolerancies[]" value="{{ $key }}" 
                                    {{ in_array($key, $selectedIntolerancies) ? 'checked' : '' }} class="form-checkbox">
                                <span class="ml-2">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>


                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Crear Plat
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
