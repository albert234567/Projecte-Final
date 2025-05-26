<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentariMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuari_id',
        'menu_id',
        'comentari',
    ];

    public function usuari()
    {
        return $this->belongsTo(User::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
