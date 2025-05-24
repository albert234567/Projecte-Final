@foreach($plats as $plat)
    <div class="item p-3 border border-gray-600 rounded mb-3 bg-gray-800 shadow-sm" draggable="true" id="plat{{ $plat->id }}" ondragstart="drag(event)">
        <h4 class="text-md font-semibold text-white">{{ $plat->nom }}</h4>
        <p class="text-sm text-white mt-1">
            {{ ucfirst($plat->tipus ?? 'No especificat') }} |
            <strong>Vegà:</strong> {{ $plat->vega ? 'Sí' : 'No' }} |
            <strong>Intoleràncies:</strong> {{ $plat->intolerancies ? implode(', ', $plat->intolerancies) : 'Cap' }}
        </p>
        <input type="hidden" name="plats_disponibles[]" value="{{ $plat->id }}">
    </div>
@endforeach
