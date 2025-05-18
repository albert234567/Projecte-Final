<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        if ($user->rol === 'nutricionista') {
            $nutricionistaId = $user->id;

            // Obtenim els IDs dels clients únics que tenen algun menú creat per aquest nutricionista
            $clientIds = Menu::where('nutricionista_id', $nutricionistaId)
                ->distinct()
                ->pluck('client_id')
                ->filter(); // Elimina possibles valors null

            // Obtenim la informació d'aquests clients des de la taula users
            $clients = User::whereIn('id', $clientIds)
                ->where('rol', 'client')
                ->get();

            return view('clients', ['clients' => $clients]);
        } else {
            // Si l'usuari no és un nutricionista, potser mostrem els seus propis menús o redirigim
            return redirect()->route('dashboard')->with('error', 'No tens accés a la llista de clients.');
        }
    }
}