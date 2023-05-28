<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ligneCommande extends Model
{
    use HasFactory;
    protected $table = 'produit_commande';
    protected $fillable = [
        'id',
        'produit_id',
        'commande_id',
        'quantite',
        
    ];
}
