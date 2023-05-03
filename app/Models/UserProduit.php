<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProduit extends Model
{
    use HasFactory;
    protected $table = 'user_produit';
    protected $fillable = ['id', 'user_id', 'produit_id'];
}
