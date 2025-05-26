<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComentariMenu;
use Illuminate\Support\Facades\Auth;

class ComentariMenuController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'comentari' => 'required|string|max:1000',
        ]);

        ComentariMenu::create([
            'usuari_id' => Auth::id(),
            'menu_id' => $request->menu_id,
            'comentari' => $request->comentari,
        ]);

        return back()->with('success', 'Comentari enviat correctament.');
    }

public function index()
{
    // Agafem comentaris amb relacions
    $comentaris = ComentariMenu::with(['menu', 'usuari'])
        ->get()
        ->groupBy('menu_id')  // agrupar per menú
        ->sortByDesc(function($comentarisMenu) {
            return $comentarisMenu->first()->menu->created_at ?? now()->subYears(100);
        });

    return view('comentaris.index', compact('comentaris'));
}




    public function usuari()
    {
        return $this->belongsTo(User::class, 'usuari_id');
    }



}
