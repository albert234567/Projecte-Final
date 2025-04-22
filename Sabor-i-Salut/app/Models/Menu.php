<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nutricionista_id',
        'client_id',
        'descripcio',
        'plats', // Aquest camp serà un array de plats en format JSON
    ];

    protected $casts = [
        'plats' => 'array', // Convertir el JSON a un array automàticament
    ];

    // Relació amb l'usuari (nutricionista)
    public function nutricionista()
    {
        return $this->belongsTo(User::class, 'nutricionista_id');
    }

    // Relació amb el client (si n'hi ha un assignat)
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
