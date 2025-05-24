<?php

// app/Http/Controllers/MenuController.php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Plat;

class MenuController extends Controller
{

public function mostrarDashboard()
{
    $user = Auth::user();

    if ($user->rol === 'nutricionista') {
        $clients = User::where('rol', 'client')
            ->where('created_by_user_id', $user->id) // <-- CANVI AQUÍ
            ->with('menusRecomanats.nutricionista')
            ->get();

        $menusCreados = Menu::where('nutricionista_id', $user->id)->get(); // Recupera els menús creats

        return view('dashboard', ['clients' => $clients, 'menusCreados' => $menusCreados]);
    } else {
        $menus = $user->menusRecomanats()->with('nutricionista')->get();
        return view('dashboard', ['menus' => $menus]);
    }
}


    // Emmagatzemar el menú creat
public function store(Request $request)
{
    // Validar que l'usuari sigui un nutricionista
    if (Auth::user()->rol !== 'nutricionista') {
        abort(403, 'No tens permís per crear menús.');
    }

$validated = $request->validate([
    'descripcio' => 'required|string|max:255',
    'plats' => 'required|array|min:1',
    'plats.*' => 'array|min:1', // Cada àpat hauria de tenir almenys un plat
    'plats.*.*' => 'integer|exists:plats,id',
    'client_id' => 'nullable|exists:users,id,rol,client',
    'created_at' => 'nullable|date',
]);


$menu = new Menu();
$menu->nutricionista_id = Auth::id();
$menu->descripcio = $validated['descripcio'];
$menu->plats = json_encode($validated['plats']); // JSON amb esmorzar, dinar, etc.
$menu->client_id = $validated['client_id'] ?? null;

if (!empty($validated['created_at'])) {
    $menu->created_at = $validated['created_at'];
    $menu->timestamps = false;
}

$menu->save();


    return redirect()->route('dashboard')->with('success', 'Menú creat correctament!');
}


    // Editar un menú
    public function edit(Menu $menu): View
    {
        $user = Auth::user();

        // Recupera només els clients creats per l'usuari autenticat (exactament igual que al ClientController)
        $clients = User::where('rol', 'client')
            ->where('created_by_user_id', $user->id)
            ->get();

        return view('menus.edit', compact('menu', 'clients'));
    }

    // Llistar els menús creats pel nutricionista o assignats al client
    public function index()
    {
        $user = Auth::user();

        if ($user->rol === 'nutricionista') {
            // Obtenim tots els menús creats per aquest nutricionista
            $menusCreados = Menu::where('nutricionista_id', $user->id)->get();

            // Obtenim tots els clients que tenen algun menú assignat per aquest nutricionista
            $clients = User::where('rol', 'client')
                ->whereHas('menusAssigned', function ($query) use ($user) {
                    $query->where('nutricionista_id', $user->id);
                })
                ->with('menusAssigned.nutricionista') // Carreguem la info del nutricionista per a aquests menús
                ->get();

            return view('dashboard', ['clients' => $clients, 'menusCreados' => $menusCreados]);
        } else {
            // Si l'usuari és un client, mostrem els menús que se li han assignat
            $menus = $user->menusAssigned()->with('nutricionista')->get();
            return view('dashboard', ['menus' => $menus]);
        }
    }
    



    // Eliminar un menú
    public function destroy(Menu $menu)
    {
        // Comprovem que l'usuari sigui el nutricionista que va crear el menú
        if (Auth::user()->rol !== 'nutricionista' || Auth::id() !== $menu->nutricionista_id) {
            abort(403, 'No tens permís per eliminar aquest menú.');
        }

        // Eliminem el menú
        $menu->delete();
        return redirect()->route('dashboard')->with('success', 'Menú eliminat correctament!');
    }

    // Assignar un menú a un client
    public function assignMenu(Request $request, $menuId)
    {
        // Busquem el menú
        $menu = Menu::findOrFail($menuId);
    
        // Comprovem que l'usuari sigui nutricionista
        if (Auth::user()->rol != 'nutricionista') {
            return redirect()->back()->with('error', 'Només els nutricionistes poden assignar menús.');
        }

        // Validem l'ID del client
        $request->validate([
            'client_id' => 'required|exists:users,id,rol,client', // Verifiquem que el client existeixi
        ]);

        // Assignem el client al menú
        $menu->client_id = $request->client_id;
        $menu->save();

        return redirect()->route('menus.index')->with('success', 'Menú assignat correctament.');
    }

public function create(Request $request)
{
    $user = Auth::user();

    // Clients creats pel nutricionista
    $clients = User::where('rol', 'client')
        ->where('created_by_user_id', $user->id)
        ->get();

    // Consulta base
    $query = Plat::query();

    // Filtres
    if ($request->filled('tipus')) {
        $query->where('tipus', $request->tipus);
    }

    if ($request->has('vega')) {
        $query->where('vega', true);
    }

    if ($request->filled('intolerancia')) {
        // Suposem que intolerancies està en JSON a la BD (array d'intoleràncies que té el plat)
        // Volem plats que NO tinguin la intolerància indicada (ex: si demanen sense gluten, el plat no ha de tenir gluten)
        $intol = $request->intolerancia;
        $query->whereJsonDoesntContain('intolerancies', $intol);
    }

    $plats = $query->get();

    return view('menus.create', compact('clients', 'plats'));
}




}
