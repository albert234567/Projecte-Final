<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-green-700 mb-2">Comentaris dels teus clients</h2>
    </x-slot>

    <div class="py-4 px-6 max-w-4xl mx-auto">
        @forelse($comentaris as $menuId => $comentarisMenu)
            <div class="bg-white shadow-md rounded p-4 mb-6">
            <h3 class="font-bold text-lg mb-2">Menú: {{ $comentarisMenu->first()->menu->descripcio ?? 'Menú eliminat' }}</h3>

            <div class="flex items-center space-x-4 mb-4">
                <div>
                    <strong>Data recomanació:</strong>
                    {{ $comentarisMenu->first()->menu->created_at->format('d/m/Y') }}
                </div>

                @php
                    // Agrupar comentaris per usuari dins aquest menú
                    $comentarisPerUsuari = $comentarisMenu->groupBy('usuari_id');
                @endphp
            </div>

                @foreach ($comentarisPerUsuari as $usuariId => $comentarisUsuari)
                    <div class="mb-4 border-b border-gray-200 pb-2">
                        <p class="font-semibold text-gray-700">Escrit per: {{ $comentarisUsuari->first()->usuari->name ?? 'Usuari desconegut' }}</p>
                        @foreach ($comentarisUsuari as $comentari)
                            <p class="ml-4">- {{ $comentari->comentari }}</p>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @empty
            <p>No hi ha comentaris.</p>
        @endforelse
    </div>
</x-app-layout>
