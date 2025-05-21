<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlatController extends Controller
{
    /**
     * Mostra la vista principal dels plats.
     */
    public function index()
    {
        // Aquí pots passar dades si cal, per ara simplement retornem la vista
        return view('plats');
    }
}
