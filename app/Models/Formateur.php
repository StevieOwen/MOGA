<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Formateur extends Model
{
    /** @use HasFactory<\Database\Factories\FormateurFactory> */
    use HasFactory;

    protected $fillable = [
            'nom',
            'prenom',
            'email',
            'qualification',
            'created_at',
            'updated_at'
        ];
    public function formations(): HasMany{
        return $this->hasMany(Formation_Formateur::class, 'formation_id');
    }
}
