<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-800">
                    <h3 class="text-xl font-semibold mb-4">Els meus clients</h3>

@if ($haArribatLimitClients)
    <div class="mb-4 p-4 bg-yellow-100 border border-yellow-300 text-yellow-800 rounded-md">
        Has arribat al límit de {{ $limitClients }} clients. <br>
        @if (!$user->premium)
            Augmenta la capacitat de clients amb l'accés <strong>premium per 20€/mes</strong> de <em>Sabor i Salut</em>.
        @else
            Ja tens accés premium i pots crear fins a {{ $limitClients }} clients.
        @endif
    </div>
@else
    <div class="inline-flex items-center space-x-2">
        <a href="{{ route('clients.register') }}" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">
            Registrar nou client
        </a>
        <!-- Emoji info amb tooltip -->
        <div class="relative group cursor-pointer">
            <span class="text-blue-500 text-lg select-none">ℹ️</span>
            <div class="absolute left-full top-1/2 -translate-y-1/2 ml-3 w-72 p-3 bg-gray-800 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity pointer-events-none z-10">
                En aquesta versió només tens un màxim de {{ $limitClients }} clients.<br>
                @if (!$user->premium)
                    Augmenta la capacitat de clients amb l'accés <strong>premium per 20€/mes</strong> de <em>Sabor i Salut</em>.
                @else
                    Tens accés premium i pots crear fins a {{ $limitClients }} clients.
                @endif
            </div>
        </div>
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

                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            onclick="return confirm('Segur que vols eliminar aquest client?')" 
                                            class="px-2 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600"
                                        >
                                            Elimina
                                        </button>
                                    </form>
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
