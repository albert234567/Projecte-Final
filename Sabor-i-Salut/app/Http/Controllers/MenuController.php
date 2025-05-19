<?php

// app/Http/Controllers/MenuController.php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    
        // Validació de dades
        $request->validate([
            'descripcio' => 'required|string|max:255',
            'plats' => 'required|array|min:1',
            'plats.*' => 'required|string|max:255',
            'client_id' => 'nullable|exists:users,id,rol,client', // Opcional per quan no es vol assignar immediatament
        ]);
    
        // Crear el menú
        $menu = Menu::create([
            'nutricionista_id' => Auth::id(),
            'descripcio' => $request->descripcio,
            'plats' => json_encode($request->plats), // Guardar els plats com JSON
            'client_id' => $request->client_id, // Assignar el client si s'ha passat
        ]);
    
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

    public function create()
    {
        // Obtenim l'usuari autenticat (el nutricionista)
        $user = Auth::user();

        // Obtenim només els clients creats per aquest nutricionista
        $clients = User::where('rol', 'client')
            ->where('created_by_user_id', $user->id)
            ->get();

        // Retornem la vista de creació amb els clients filtrats
        return view('menus.create', compact('clients'));
    }
}
