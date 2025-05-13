<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // ✅ Captura l'usuari autenticat

        // Obtenim els menús segons el rol de l'usuari
        if ($user->rol === 'nutricionista') {
            $menus = Menu::where('nutricionista_id', $user->id)->get();
        } else {
            $menus = Menu::where('client_id', $user->id)->get();
        }

        // Passem $user i $menus a la vista
        return view('dashboard', compact('menus', 'user'));
    }
}
