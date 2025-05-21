<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Menu;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    
public function index(Request $request)
{
    $user = Auth::user();
    $dataSeleccionada = $request->input('data_menu', 'tots'); // per defecte "tots"

    if ($user->rol === 'nutricionista') {
        $menusQuery = Menu::where('nutricionista_id', $user->id);

        if ($dataSeleccionada !== 'tots') {
            $menusQuery = $menusQuery->whereDate('created_at', $dataSeleccionada);
        }

        $menusCreadosPorCliente = $menusQuery->get()
            ->groupBy(function ($menu) {
                return $menu->client->name ?? 'Sense client assignat';
            });

        $clientIds = $menusQuery->pluck('client_id')->unique()->filter();
        $clients = User::where('rol', 'client')
            ->whereIn('id', $clientIds)
            ->get();

        return view('dashboard', [
            'menusCreadosPorCliente' => $menusCreadosPorCliente,
            'clients' => $clients,
            'dataSeleccionada' => $dataSeleccionada,
        ]);
    } else {
        // Client
        $menusQuery = $user->menusAssigned()->with('nutricionista');

        if ($dataSeleccionada !== 'tots') {
            $menusQuery = $menusQuery->whereDate('created_at', $dataSeleccionada);
        }

        $menus = $menusQuery->get();

        return view('dashboard', [
            'menus' => $menus,
            'dataSeleccionada' => $dataSeleccionada,
        ]);
    }
}




}