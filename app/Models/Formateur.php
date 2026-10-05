<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    public function formations(): BelongsToMany{
        return $this->belongsToMany(Formation::class,'formation__formateurs','formateur_id','formation_id');
    }
}
