<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-700 leading-tight">
            {{ __('Menus') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #ffffff;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-green-200">
                <div class="p-6 text-gray-800">
                    <!-- Missatge de benvinguda -->
                    <h1 class="text-green-700" style="color: #4CAF50;">Hola, aquest és el teu Dashboard!</h1>

                    <!-- Secció per mostrar els menús segons el rol -->
                    <div class="mt-8">
                        @if(Auth::user()->rol === 'nutricionista')
                            <h2 class="text-xl font-semibold text-green-700 mb-2">Els teus menús creats</h2>
                            <p class="mb-4">Com a nutricionista, pots crear menús per als teus clients.</p>
                            <a href="{{ route('menus.create') }}"
                               class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Crear Menú</a>
                        @else
                            <h2 class="text-xl font-semibold text-green-700 mb-2">Els teus menús assignats</h2>

                            @if($menus->isEmpty())
                                <p>No tens menús assignats.</p>
                            @else
                                <ul class="list-disc list-inside">
                                    @foreach($menus as $menu)
                                        <li class="mb-4">
                                            <strong>{{ $menu->descripcio }}</strong><br>
                                            Plats: {{ implode(', ', json_decode($menu->plats)) }}<br>
                                            Nutricionista: {{ $menu->nutricionista->name ?? 'Desconegut' }}
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
</x-app-layout>
