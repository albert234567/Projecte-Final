<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;  // ✅ Import correcte
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Plat extends Model
{
    protected $fillable = ['nom', 'descripcio', 'quantitat', 'tipus', 'vega', 'intolerancies'];

    protected $casts = [
        'vega' => 'boolean',
        'intolerancies' => 'array',
    ];
}
