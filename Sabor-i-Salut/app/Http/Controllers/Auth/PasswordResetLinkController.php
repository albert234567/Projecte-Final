<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Mostra el formulari per demanar el restabliment de contrasenya.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Envia el correu electrònic amb el link per restablir la contrasenya.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validar l'email
        $request->validate(['email' => 'required|email']);

        // Enviar l'enllaç de restabliment
        $response = Password::sendResetLink(
            $request->only('email')  // Agafem només l'email
        );

        if ($response == Password::RESET_LINK_SENT) {
            // Si l'enllaç s'ha enviat correctament
            return back()->with('status', 'Si el correu electrònic existeix, s\'ha enviat un enllaç per restablir la contrasenya.');
        }

        // Si l'email no existeix o alguna cosa ha fallat
        return back()->withErrors(['email' => 'Aquest correu electrònic no està registrat.']);
    }
}
