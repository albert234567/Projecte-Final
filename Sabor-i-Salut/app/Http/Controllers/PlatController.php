<?php

namespace App\Http\Controllers;

use App\Models\Plat;
use Illuminate\Http\Request;

class PlatController extends Controller
{
    /**
     * Mostra tots els plats.
     */
    public function index(Request $request)
    {
        $query = Plat::query();

        // Filtrar per tipus (esmorzar, dinar, berenar, sopar)
        if ($request->filled('tipus')) {
            $query->where('tipus', $request->tipus);
        }

        // Filtrar per vegà (checkbox)
        if ($request->filled('vega')) {
            $query->where('vega', true);
        }

        // Filtrar per intolerància (ex: lactosa, gluten, etc.)
        if ($request->filled('intolerancia')) {
            // Busquem plats on la intolerància NO està a la llista d’intoleràncies.
            $intolerancia = $request->intolerancia;

            $query->where(function($q) use ($intolerancia) {
                $q->whereNull('intolerancies')
                ->orWhereJsonDoesntContain('intolerancies', $intolerancia);
            });
        }

        $plats = $query->paginate(15);

        return view('plats.index', compact('plats'));
    }


    /**
     * Mostra el formulari per crear un nou plat.
     */
    public function create()
    {
        return view('plats.create');
    }

    /**
     * Desa un nou plat.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            'tipus' => 'nullable|string|in:esmorzar,dinar,berenar,sopar',
            'vega' => 'nullable|boolean',
            'intolerancies' => 'nullable|array',
            'intolerancies.*' => 'string',
        ]);

        Plat::create($request->only('nom', 'descripcio', 'tipus', 'vega', 'intolerancies'));

        return redirect()->route('plats.index')->with('success', 'Plat creat correctament.');
    }

    /**
     * Mostra el formulari d’edició.
     */
    public function edit(Plat $plat)
    {
        return view('plats.edit', compact('plat'));
    }

    /**
     * Actualitza el plat.
     */
    public function update(Request $request, Plat $plat)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            'tipus' => 'nullable|string|in:esmorzar,dinar,berenar,sopar',
            'vega' => 'nullable|boolean',
            'intolerancies' => 'nullable|array',
            'intolerancies.*' => 'string',
        ]);

        $plat->update($request->only('nom', 'descripcio', 'tipus', 'vega', 'intolerancies'));

        return redirect()->route('plats.index')->with('success', 'Plat actualitzat correctament.');
    }

    /**
     * Elimina el plat.
     */
    public function destroy(Plat $plat)
    {
        $plat->delete();

        return redirect()->route('plats.index')->with('success', 'Plat eliminat correctament.');
    }
}
