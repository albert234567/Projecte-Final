@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-8">
    <h1 class="text-2xl font-bold mb-6">Edita el teu Perfil</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 mb-6">
            {{ session('success') }}
        </div>
    @endif

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

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar canvis</button>
        </div>
    </form>

    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-8">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar el teu compte</button>
    </form>
</div>
@endsection
