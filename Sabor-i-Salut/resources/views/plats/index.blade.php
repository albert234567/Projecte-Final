<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-green-200">
                <div class="p-6 text-gray-800">

                    <h2 class="text-xl font-semibold text-green-700 mb-6">
                        Gestió de Plats
                    </h2>

                    <form method="GET" action="{{ route('plats.index') }}" class="mb-6 flex flex-wrap gap-4 items-center">

                        <select name="tipus" class="px-4 py-2 border rounded">
                            <option value="" {{ request('tipus') == '' ? 'selected' : '' }}>Tots</option>
                            <option value="esmorzar" {{ request('tipus') == 'esmorzar' ? 'selected' : '' }}>Esmorzar</option>
                            <option value="dinar" {{ request('tipus') == 'dinar' ? 'selected' : '' }}>Dinar</option>
                            <option value="berenar" {{ request('tipus') == 'berenar' ? 'selected' : '' }}>Berenar</option>
                            <option value="sopar" {{ request('tipus') == 'sopar' ? 'selected' : '' }}>Sopar</option>
                        </select>


                        <label class="inline-flex items-center">
                            <input type="checkbox" name="vega" value="1" {{ request()->has('vega') ? 'checked' : '' }} class="form-checkbox">
                            <span class="ml-2">Vegà</span>
                        </label>

                        <select name="intolerancia" class="border rounded px-3 py-1">
                            <option value="">-- Sense intoleràncies --</option>
                            <option value="lactosa" {{ request('intolerancia') == 'lactosa' ? 'selected' : '' }}>Lactosa</option>
                            <option value="gluten" {{ request('intolerancia') == 'gluten' ? 'selected' : '' }}>Gluten</option>
                            <option value="fruits_secs" {{ request('intolerancia') == 'fruits_secs' ? 'selected' : '' }}>Fruits secs</option>
                        </select>

                        <button type="submit" class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">Filtrar</button>

                        <a href="{{ route('plats.index') }}" class="ml-2 text-blue-600 hover:underline">Netejar filtres</a>
                    </form>

                                        @if(request()->hasAny(['tipus', 'vega', 'intolerancia']))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded text-green-700">
                            <strong>Filtres aplicats:</strong>
                            <ul class="list-disc list-inside mt-2">
                                @if(request('tipus'))
                                    <li>Tipus: {{ ucfirst(request('tipus')) }}</li>
                                @endif
                                @if(request()->has('vega'))
                                    <li>Vegà: Sí</li>
                                @endif
                                @if(request('intolerancia'))
                                    <li>Intolerància: {{ ucfirst(str_replace('_', ' ', request('intolerancia'))) }}</li>
                                @endif
                            </ul>
                        </div>
                    @endif


                    <a href="{{ route('plats.create') }}"
                       class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 inline-block mb-6">
                        Crear Nou Plat
                    </a>

                    @if($plats->isEmpty())
                        <p class="text-gray-600">Encara no hi ha cap plat creat.</p>
                    @else
                        <ul class="space-y-4">
                            @foreach($plats as $plat)
                                <li class="p-4 border border-gray-200 rounded-md shadow-sm bg-white flex justify-between items-start">
                                    <div>
                                        <h4 class="text-md font-semibold text-green-700">{{ $plat->nom }}</h4>
                                        @if($plat->descripcio)
                                            <p class="mt-1 text-gray-700">{{ $plat->descripcio }}</p>
                                        @endif
                                        <p class="mt-1 text-sm text-gray-500">
                                            <strong>Tipus:</strong> {{ ucfirst($plat->tipus ?? 'No especificat') }} |
                                            <strong>Vegà:</strong> {{ $plat->vega ? 'Sí' : 'No' }} |
                                            <strong>Intoleràncies:</strong> {{ $plat->intolerancies ? implode(', ', $plat->intolerancies) : 'Cap' }}
                                        </p>
                                    </div>

                                    <div class="flex space-x-2">
                                        <a href="{{ route('plats.edit', $plat->id) }}"
                                           class="px-2 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 text-sm">
                                            Editar
                                        </a>
                                        <form action="{{ route('plats.destroy', $plat->id) }}" method="POST"
                                              onsubmit="return confirm('Segur que vols eliminar aquest plat?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-2 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 text-sm">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <div class="mt-6">
                            {{ $plats->withQueryString()->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
