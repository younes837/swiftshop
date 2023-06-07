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
        'photo',
        'stock',
        'price',
        'rating',
        'categorie_id',
        'favorie','brand_id','propriete_id'
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
