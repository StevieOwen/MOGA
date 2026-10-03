<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Formation_Formateur extends Model
{
    /** @use HasFactory<\Database\Factories\FormationFormateurFactory> */
    use HasFactory;
    protected $fillable = [
        'formation_id',
        'formateur_id',
    ];
     public function formation(): BelongsTo
    {
        return $this->belongsTo(Formation::class);
    }

    public function formateur(): BelongsTo
    {
        return $this->belongsTo(Formateur::class);
    }

}
