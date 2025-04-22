<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Nom -->
    <div>
        <label for="name">Nom</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
        @error('name')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- Correu electrònic -->
    <div>
        <label for="email">Correu electrònic</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- Contrasenya -->
    <div>
        <label for="password">Contrasenya</label>
        <input type="password" id="password" name="password" required>
        @error('password')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- Confirmar contrasenya -->
    <div>
        <label for="password_confirmation">Confirmar contrasenya</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>

    <!-- Rol -->
    <div>
        <label for="rol">Rol</label>
        <select name="rol" id="rol" required>
            <option value="client" {{ old('rol') == 'client' ? 'selected' : '' }}>Client</option>
            <option value="nutricionista" {{ old('rol') == 'nutricionista' ? 'selected' : '' }}>Nutricionista</option>
        </select>
        @error('rol')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Registrar</button>
</form>
