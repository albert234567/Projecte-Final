<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;  // ✅ Import correcte


class Plat extends Model
{
    protected $fillable = ['nom', 'descripcio', 'tipus', 'vega', 'intolerancies'];

    protected $casts = [
        'vega' => 'boolean',
        'intolerancies' => 'array',
    ];
}
