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

    public function index()
    {
        $user = Auth::user();

        // Obtenir els clients creats per aquest nutricionista
        $clients = User::where('rol', 'client')
            ->where('created_by_user_id', $user->id)
            ->get();

        // Calcular si ha arribat al límit
        $haArribatLimitClients = $clients->count() >= 3;

        // Passar les dades a la vista
        return view('clients', compact('clients', 'haArribatLimitClients'));
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

    public function destroy($id)
{
    $user = Auth::user();

    // Comprova que el client existeix i que l'ha creat aquest nutricionista
    $client = User::where('id', $id)
        ->where('rol', 'client')
        ->where('created_by_user_id', $user->id)
        ->firstOrFail();
        
    Menu::where('client_id', $client->id)->delete();

    // Elimina el client
    $client->delete();

    return redirect()->route('clients')->with('success', 'Client eliminat correctament.');
}


}