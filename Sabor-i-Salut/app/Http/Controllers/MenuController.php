<?php

// app/Http/Controllers/MenuController.php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MenuController extends Controller
{
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
    
        return redirect()->route('menus.index')->with('success', 'Menú creat correctament!');
    }

    // Editar un menú
    public function edit(Menu $menu)
    {
        // Comprovem que l'usuari sigui el nutricionista que va crear el menú
        if (Auth::user()->rol !== 'nutricionista' || Auth::id() !== $menu->nutricionista_id) {
            abort(403, 'No tens permís per editar aquest menú.');
        }
    
        return view('menus.edit', compact('menu'));
    }

    // Llistar els menús creats pel nutricionista o assignats al client
    public function index()
    {
        // Els nutricionistes veuen només els seus menús
        if (Auth::user()->rol === 'nutricionista') {
            $menus = Menu::where('nutricionista_id', Auth::id())->get();
        } else {
            // Els clients només veuen els menús assignats a ells
            $menus = Menu::where('client_id', Auth::id())->get();
        }

        // Passa també els clients per a assignar menús
        $clients = User::where('rol', 'client')->get();

        return view('menus.index', compact('menus', 'clients'));
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
        return redirect()->route('menus.index')->with('success', 'Menú eliminat correctament!');
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

    // Formulari de creació de menús
    public function create()
    {
        // Obtenim tots els clients
        $clients = User::where('rol', 'client')->get();
        
        // Retornem la vista de creació amb els clients
        return view('menus.create', compact('clients'));
    }
}
