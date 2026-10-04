<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Formation extends Model
{
    /** @use HasFactory<\Database\Factories\FormationFactory> */
    use HasFactory;
    protected $fillable = [
        'intitule',
        'image',
        'categorie',
        'prix',
        'duree',
        'disponible',
        'date_debut',
        'date_fin',
        'created_at',
        'updated_at'
    ];

    public function clients(): HasMany{
        return $this->hasMany(Formation_client::class, 'client_id');
    }

     public function modules(): HasMany{
        return $this->hasMany(Module::class);
    }

    public function formateurs(): HasMany{
        return $this->hasMany(Formation_Formateur::class, 'formation_id');
    }
}
