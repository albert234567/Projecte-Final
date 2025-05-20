<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-800">
                    <h3 class="text-xl font-semibold mb-4">Els meus clients</h3>

                    @if ($clients->count() < 2)
                        <a href="{{ route('clients.register') }}" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">
                            Registrar nou client
                        </a>
                    @else
                        <div class="mb-4 p-4 bg-yellow-100 border border-yellow-300 text-yellow-800 rounded-md">
                            Has arribat al límit de 2 clients. <br>
                            Augmenta la capacitat de clients amb l'accés <strong>premium</strong> de <em>Sabor i Salut</em>.
                        </div>
                    @endif

                    <br><br>

                    @if ($clients->isEmpty())
                        <p>No tens clients assignats.</p>
                    @else
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <ul>
                                @foreach ($clients as $client)
                                    <div class="mb-4 p-4 border border-gray-200 rounded-md">
                                        <li>{{ $client->name }} ({{ $client->email }})</li>
                                        {{-- Aquí pots afegir més informació del client --}}
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
