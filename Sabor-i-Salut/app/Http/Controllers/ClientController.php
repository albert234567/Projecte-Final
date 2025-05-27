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

    // Definir límit segons si és premium o no
    $limitClients = $user->premium ? 10 : 3;

    // Calcular si ha arribat al límit
    $haArribatLimitClients = $clients->count() >= $limitClients;

    // Passar les dades a la vista, assegurant que totes les variables existeixen
    return view('clients', [
        'clients' => $clients,
        'haArribatLimitClients' => $haArribatLimitClients,
        'limitClients' => $limitClients,
        'user' => $user,
    ]);
}



public function storeClient(Request $request)
{
    $user = Auth::user();

    // Comptar clients creats
    $clientsCount = User::where('rol', 'client')
        ->where('created_by_user_id', $user->id)
        ->count();

    $limitClients = $user->premium ? 10 : 3;

    if ($clientsCount >= $limitClients) {
        return redirect()->route('clients')
            ->withErrors(['limit' => "Has arribat al límit de $limitClients clients."]);
    }

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
        'created_by_user_id' => $user->id,
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