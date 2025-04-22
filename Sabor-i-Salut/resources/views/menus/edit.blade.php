@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar menú</h2>
        <form action="{{ route('menus.update', $menu->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="descripcio">Descripció</label>
                <input type="text" name="descripcio" class="form-control" value="{{ $menu->descripcio }}" required>
            </div>
            <div class="form-group">
                <label for="plats">Plats</label>
                <input type="text" name="plats[]" class="form-control" value="{{ implode(', ', json_decode($menu->plats)) }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Guardar canvis</button>
        </form>
    </div>
@endsection
