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

        if ($request->filled('intolerancia')) {
            $intolerancia = $request->intolerancia;

            // Mostrar només plats que contenen aquesta intolerància
            $query->whereJsonContains('intolerancies', $intolerancia);
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
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            'quantitat' => 'nullable|string|max:255', // <-- AFEGIT: Validació per al nou camp quantitat
            'tipus' => 'nullable|string|in:esmorzar,dinar,berenar,sopar',
            'vega' => 'nullable|boolean',
            'intolerancies' => 'nullable|array',
            'intolerancies.*' => 'string', // Pots afegir validació 'in' aquí si vols valors concrets
        ]);

        // Crea el plat amb les dades validades, incloent 'quantitat'
        $plat = Plat::create([
            'nom' => $validatedData['nom'],
            'descripcio' => $validatedData['descripcio'],
            'quantitat' => $validatedData['quantitat'] ?? null, // <-- AFEGIT: Desem la quantitat
            'tipus' => $validatedData['tipus'],
            'vega' => $validatedData['vega'] ?? false, // Assegura un valor booleà per 'vega'
            'intolerancies' => $validatedData['intolerancies'] ?? [], // Assegura un array per 'intolerancies'
            'created_by_user_id' => auth()->id(), // Assegura que l'usuari autenticat crea el plat
        ]);

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
        $validatedData = $request->validate([ // <-- CANVIAT: Utilitzem $validatedData
            'nom' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            'quantitat' => 'nullable|string|max:255', // <-- AFEGIT: Validació per al nou camp quantitat
            'tipus' => 'nullable|string|in:esmorzar,dinar,berenar,sopar',
            'vega' => 'nullable|boolean',
            'intolerancies' => 'nullable|array',
            'intolerancies.*' => 'string', // Pots afegir validació 'in' aquí si vols valors concrets
        ]);

        $plat->update([ // <-- CANVIAT: Passem l'array validat
            'nom' => $validatedData['nom'],
            'descripcio' => $validatedData['descripcio'],
            'quantitat' => $validatedData['quantitat'] ?? null, // <-- AFEGIT: Actualitzem la quantitat
            'tipus' => $validatedData['tipus'],
            'vega' => $validatedData['vega'] ?? false,
            'intolerancies' => $validatedData['intolerancies'] ?? [],
        ]);


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

    public function filter(Request $request)
    {
        $query = Plat::query();

        // Filtre per Vegà
        if ($request->boolean('vega')) {
            $query->where('vega', true);
        }

        // Filtre per Intoleràncies (AND lògic)
        $intolerancies = $request->input('intolerancies', []);
        if (!empty($intolerancies)) {
            // Assegurem-nos que $intolerancies és un array
            if (!is_array($intolerancies)) {
                $intolerancies = [$intolerancies];
            }

            // Apliquem una condició JSON_CONTAINS per cada intolerància seleccionada.
            // Això crea un AND lògic automàticament.
            foreach ($intolerancies as $intolerancia) {
                // IMPORTANT: Assegura't que el valor 'Sense lactosa', 'Sense gluten', etc.
                // coincideix exactament amb el format guardat a la teva BD (casella, espais).
                $query->whereRaw("JSON_CONTAINS(intolerancies, '\"{$intolerancia}\"')");
            }
            // NO afegis aquesta línia si vols que el plat pugui tenir les 3 seleccionades + alguna més:
            // $query->whereRaw('JSON_LENGTH(intolerancies) = ?', [count($intolerancies)]);
        }

        $plats = $query->get();

        // Retorna els plats com a JSON a la petició AJAX
        return response()->json($plats);
    }
}