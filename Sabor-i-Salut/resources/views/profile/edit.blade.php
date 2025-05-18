<x-app-layout>
    <div class="max-w-4xl mx-auto p-8">
        <h1 class="text-2xl font-bold mb-6">Edita el teu Perfil</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Utilitzem el component per al formulari -->
        <x-profile-form :user="$user">
            <!-- Aquest contingut és passat com a slot -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar canvis</button>
        </x-profile-form>

        <!-- Formulari per eliminar el compte -->
        <form method="POST" action="{{ route('profile.destroy') }}" class="mt-8">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar el teu compte</button>
        </form>
    </div>
</x-app-layout>
