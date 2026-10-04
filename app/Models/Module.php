<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Module extends Model
{
    /** @use HasFactory<\Database\Factories\ModuleFactory> */
    use HasFactory;
    protected $fillable = [
        'nom',
        'formation_id',
        'created_at',
        'updated_at'
    ];

    public function formation(): BelongsTo
    {
        return $this->belongsTo(Formation::class);
    }
}
