<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    /** @use HasFactory<\Database\Factories\AnnonceFactory> */
    use HasFactory;
    protected $fillable = [
        'titre',
        'description',
        'image',
        'categorie',
        'created_at',
        'updated_at'
    ];
}
