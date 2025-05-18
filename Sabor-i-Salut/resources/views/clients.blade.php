<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-800">
                    <h3 class="text-xl font-semibold mb-4">Els meus clients</h3>
                    @if ($clients->isEmpty())
                        <p>No tens clients assignats.</p>
                    @else
                        <ul>
                            @foreach ($clients as $client)
                                <li>{{ $client->name }} ({{ $client->email }})</li>
                                {{-- Aquí pots afegir més informació del client --}}
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>