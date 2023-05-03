<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $table = 'produit';
    protected $fillable = [
        'libelle',
        'description',
        'brand',
        'stock',
        'rating',
        'categorie_id',
        'favorie',
    ];
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'user_produit',
            'produit_id',
            'user_id',
            'id',
            'id'
        );
    }
}
