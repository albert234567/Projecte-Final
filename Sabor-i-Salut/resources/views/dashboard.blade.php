<x-app-layout>
    <div class="py-12" style="background-color: #ffffff;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-green-200">
                <div class="p-6 text-gray-800">
                    <form method="GET" action="{{ route('dashboard') }}" class="mb-4 flex items-center space-x-2">
                        <input type="date" name="data_menu" value="{{ $dataSeleccionada !== 'tots' ? $dataSeleccionada : '' }}" class="border rounded px-2 py-1" />
                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                            Filtrar per data
                        </button>

                        <a href="{{ route('dashboard', ['data_menu' => 'tots']) }}" 
                        class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                            Mostrar tots
                        </a>
                    </form>


                    <div class="mt-8">
                        @if(Auth::user()->rol === 'nutricionista')
                            <h2 class="text-xl font-semibold text-green-700 mb-2">Hola {{ Auth::user()->name }}, aquests són els menús que has creat per als teus clients</h2>
                            <br>
                            <a href="{{ route('menus.create') }}"
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 inline-block mb-4">Crear Menú</a>

                            @if($menusCreadosPorCliente->isEmpty())
                                <p class="mb-4">No has creat cap menú encara.</p>
                            @else
                                @foreach($menusCreadosPorCliente as $nomClient => $menusDelClient)
                                    <div x-data="{ open: false }" class="mb-4">
                                        <h3 @click="open = !open"
                                            class="text-lg font-semibold text-green-700 mb-2 mt-4 cursor-pointer hover:underline">
                                            Menús per a {{ $nomClient }}
                                        </h3>
                                        <ul x-show="open" x-transition.duration.300ms class="space-y-4">
                                            @foreach($menusDelClient as $menu)
                                                @php
                                                    $platsCreados = json_decode($menu->plats, true);
                                                @endphp
                                                <li class="p-4 border border-gray-200 rounded-md shadow-sm bg-white flex justify-between items-center">
                                                    <div>
                                                        <h4 class="text-md font-semibold text-green-700">{{ $menu->descripcio }}</h4>
                                                        @php
                                                            $platsDecoded = json_decode($menu->plats, true);
                                                        @endphp

                                                        <ul>
                                                            @foreach (['esmorzar', 'dinar', 'berenar', 'sopar'] as $menjador)
                                                                <li>
                                                                    <strong>{{ ucfirst($menjador) }}:</strong>
                                                                    @foreach ($platsDecoded[$menjador] ?? [] as $index => $platId)
                                                                        @php
                                                                            $plat = \App\Models\Plat::find($platId);
                                                                            $elementId = $menjador . '-' . $index;
                                                                        @endphp
                                                                        @if ($plat)
                                                                            <span class="toggle-plat" data-target="{{ $elementId }}" style="cursor:pointer;">
                                                                                ▶️ {{ $plat->nom }}
                                                                            </span>
                                                                            <div id="{{ $elementId }}" style="display:none; margin-left: 1.5em; margin-top: 0.3em;">
                                                                                <p><strong>Descripció:</strong> {{ $plat->descripcio }}</p>
                                                                                <p><strong>Quantitat:</strong> {{ $plat->quantitat }}</p>
                                                                                <p><strong>Intoleràncies:</strong> {{ is_array($plat->intolerancies) ? implode(', ', $plat->intolerancies) : 'Cap' }}</p>
                                                                                <p><strong>Vega:</strong> {{ $plat->vega == 1 ? 'Si' : 'No' }}</p>
                                                                            </div>
                                                                            @if (!$loop->last)
                                                                                , 
                                                                            @endif
                                                                        @else
                                                                            <span>Plat eliminat</span>
                                                                        @endif
                                                                    @endforeach
                                                                </li>
                                                            @endforeach
                                                        </ul>



                                                        <p class="mt-2 text-sm text-gray-500">
                                                            <strong>Data creació:</strong> {{ $menu->created_at->format('d/m/Y') }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="px-2 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 text-xs ml-2"
                                                                    onclick="return confirm('Estàs segur que vols eliminar aquest menú?')">Eliminar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            @endif
                        @else
                            <h2 class="text-xl font-semibold text-green-700 mb-2">Hola {{ Auth::user()->name }}, aquests són els teus menús assignats</h2>
                            <br>

                            @if(isset($menus) && $menus->isEmpty())
                                <p>No tens menús assignats.</p>
                            @elseif(isset($menus))
                                <ul class="space-y-4">
                                    @foreach($menus as $menu)
                                        @php
                                            $plats = json_decode($menu->plats, true);
                                        @endphp
                                        <li class="p-4 border border-gray-200 rounded-md shadow-sm bg-white">
                                            <h3 class="text-lg font-semibold text-green-700">{{ $menu->descripcio }}</h3>
                                            @php
                                                $platsDecoded = json_decode($menu->plats, true);
                                            @endphp

                                            <ul>
                                                @foreach (['esmorzar', 'dinar', 'berenar', 'sopar'] as $menjador)
                                                    <li>
                                                        <strong>{{ ucfirst($menjador) }}:</strong>
                                                        @foreach ($platsDecoded[$menjador] ?? [] as $index => $platId)
                                                            @php
                                                                $plat = \App\Models\Plat::find($platId);
                                                                $elementId = $menjador . '-' . $index;
                                                            @endphp
                                                            @if ($plat)
                                                                <span class="toggle-plat" data-target="{{ $elementId }}" style="cursor:pointer;">
                                                                    ▶️ {{ $plat->nom }}
                                                                </span>
                                                                <div id="{{ $elementId }}" style="display:none; margin-left: 1.5em; margin-top: 0.3em;">
                                                                    <p><strong>Descripció:</strong> {{ $plat->descripcio }}</p>
                                                                    <p><strong>Quantitat:</strong> {{ $plat->quantitat }}</p>
                                                                    <p><strong>Intoleràncies:</strong> {{ is_array($plat->intolerancies) ? implode(', ', $plat->intolerancies) : 'Cap' }}</p>
                                                                    <p><strong>Vega:</strong> {{ $plat->vega == 1 ? 'Si' : 'No' }}</p>
                                                                </div>
                                                                @if (!$loop->last)
                                                                    , 
                                                                @endif
                                                            @else
                                                                <span>Plat eliminat</span>
                                                            @endif
                                                        @endforeach
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <p class="mt-2 text-sm text-gray-500">
                                                <strong>Nutricionista:</strong> {{ $menu->nutricionista->name ?? 'Desconegut' }}
                                                <br>
                                                <strong>Data recomanació:</strong>
                                                @if ($menu->created_at)
                                                    {{ $menu->created_at->format('d/m/Y') }}
                                                @else
                                                    {{ 'No disponible' }} {{-- Or any other appropriate message --}}
                                                @endif
                                            </p>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/plat-toggle.js') }}"></script>
</x-app-layout>
