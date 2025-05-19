<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();


    if ($user->rol === 'nutricionista') {
        $clients = User::where('rol', 'client')
            ->where('created_by_user_id', $user->id)
            ->get();

        return view('clients', ['clients' => $clients]);
    } else {
            // Si l'usuari no és un nutricionista, potser mostrem els seus propis menús o redirigim
            return redirect()->route('dashboard')->with('error', 'No tens accés a la llista de clients.');
        }
    }

        public function storeClient(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => 'client',
            'created_by_user_id' => Auth::id(), // Assigna l'ID del nutricionista loguejat
        ]);

        return redirect()->route('clients')->with('success', 'Client registrat amb èxit.');
    }

}