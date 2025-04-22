@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Menús</h2>

        @if (Auth::user()->rol === 'nutricionista')
            <a href="{{ route('menus.create') }}" class="btn btn-primary mb-3">Crear un nou menú</a>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Descripció</th>
                    <th>Plats</th>
                    <th>Client assignat</th>
                    <th>Accions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                    <tr>
                        <td>{{ $menu->descripcio }}</td>
                        <td>{{ implode(', ', json_decode($menu->plats)) }}</td>
                        <td>
                            @if ($menu->client_id)
                                {{ $menu->client->name }} <!-- Nom del client assignat -->
                            @else
                                <span>No assignat</span>
                            @endif
                        </td>
                        <td>
                            @if (Auth::user()->rol === 'nutricionista')
                                @if (!$menu->client_id) <!-- Només si el menú no està assignat -->
                                    <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning">Editar</a>
                                    
                                    <!-- Formulari d'eliminar el menú -->
                                    <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                    
                                    <!-- Formulari per assignar un client -->
                                    <form action="{{ route('menus.assign', $menu->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <label for="client_id">Assignar a client:</label>
                                        <select name="client_id" required>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}" {{ $menu->client_id == $client->id ? 'selected' : '' }}>
                                                    {{ $client->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="custom-btn">Crear Menú</button>


                                    </form>
                                @else
                                    <p>Menú assignat a: {{ $menu->client->name }}</p>
                                @endif
                            @else
                                <p>Menú assignat: {{ $menu->descripcio }}</p>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
