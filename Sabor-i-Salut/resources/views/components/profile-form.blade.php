<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')

    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="mt-1 p-2 border rounded w-full">
    </div>

    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Correu electrònic</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="mt-1 p-2 border rounded w-full">
    </div>

    <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Contrasenya</label>
        <input type="password" id="password" name="password" class="mt-1 p-2 border rounded w-full" placeholder="Deixa en blanc per no canviar-la">
    </div>

    <div class="mb-4">
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar contrasenya</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 p-2 border rounded w-full">
    </div>

    <!-- Aquí es passarà el contingut del slot -->
    <div class="flex items-center justify-between">
        {{ $slot }} <!-- Aquest és el botó "Guardar canvis" -->
    </div>
</form>
