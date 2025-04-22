<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtenim els menús segons el rol de l'usuari
        if (Auth::user()->rol === 'nutricionista') {
            $menus = Menu::where('nutricionista_id', Auth::id())->get();
        } else {
            $menus = Menu::where('client_id', Auth::id())->get();
        }

        // Retornem la vista del dashboard amb la variable $menus
        return view('dashboard', compact('menus'));
    }
}
