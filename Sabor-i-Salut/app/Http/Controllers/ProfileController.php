<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\Menu;
use Exception;

class ProfileController extends Controller
{
    /**
     * Mostra el formulari d'edició del perfil.
     */
   // ProfileController.php
public function edit()
{
    $user = Auth::user();

    // Obtenir els menús assignats o creats per l'usuari
    if ($user->rol === 'nutricionista') {
        $menus = Menu::where('nutricionista_id', $user->id)->get(); // Menús creats per aquest nutricionista
    } else {
        $menus = Menu::where('client_id', $user->id)->get(); // Menús assignats a aquest client
    }

    return view('profile.edit', compact('user', 'menus'));
}


    /**
     * Actualitza les dades del perfil.
     */
    public function update(Request $request)
    {
        try {
            // Validar les dades
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
                'password' => ['nullable', 'confirmed', Password::min(8)->letters()->numbers()],
            ]);

            // Obtenir l'usuari autenticat
            $user = Auth::user();
            $user->name = $request->name;
            $user->email = $request->email;

            // Si hi ha una nova contrasenya, la guardem
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            // Per veure com quedaria l'objecte abans de guardar-lo
            dd($user);

            // Guardar les dades del perfil (després de verificar que tot està correcte)
            $user->save();

            // Redirigir amb missatge d'èxit
            return redirect()->route('profile.edit')->with('success', 'Perfil actualitzat correctament!');
        } catch (Exception $e) {
            // En cas d'error, mostrar el missatge d'error
            return redirect()->route('profile.edit')->with('error', 'Error en actualitzar el perfil: ' . $e->getMessage());
        }
    }

    /**
     * Elimina el perfil de l'usuari.
     */
    public function destroy()
    {
        try {
            $user = Auth::user();

            // Per veure com quedaria l'objecte abans d'eliminar-lo
            dd($user);

            // Eliminar l'usuari (després de verificar que tot està correcte)
            $user->delete();

            // Redirigir amb missatge d'èxit
            return redirect('/')->with('success', 'El teu compte ha estat eliminat.');
        } catch (Exception $e) {
            // En cas d'error, mostrar el missatge d'error
            return redirect()->route('profile.edit')->with('error', 'Error en eliminar el compte: ' . $e->getMessage());
        }
    }

    public function show()
    {
        $user = Auth::user();
        
        // Comprovem el rol i obtenim els menús
        if ($user->rol === 'nutricionista') {
            // Els nutricionistes veuen els seus menús creats
            $menus = Menu::where('nutricionista_id', Auth::id())->get();
        } else {
            // Els clients veuen els menús assignats a ells
            $menus = Menu::where('client_id', Auth::id())->get();
        }

        return view('profile', compact('user', 'menus'));
    }

}
