<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Menu;

class DashboardController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();

        if ($user->rol === 'nutricionista') {
            $menusCreadosPorCliente = Menu::where('nutricionista_id', $user->id)
                ->get()
                ->groupBy(function ($menu) {
                    return $menu->client->name ?? 'Sense client assignat'; // Agrupa per el nom del client
                });

            $clients = User::where('rol', 'client')
                ->whereIn('id', Menu::where('nutricionista_id', $user->id)->pluck('client_id')->unique()->filter())
                ->get();

            return view('dashboard', [
                'menusCreadosPorCliente' => $menusCreadosPorCliente,
                'clients' => $clients,
            ]);
        } else {
            $menus = $user->menusAssigned()->with('nutricionista')->get();
            return view('dashboard', ['menus' => $menus]);
        }
    }

}