<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Formation_client extends Model
{
    /** @use HasFactory<\Database\Factories\FormationClientFactory> */
    use HasFactory;
    protected $fillable = [
        'formation_id',
        'client_id',
    ];

   
    public function formation(): BelongsTo
    {
        return $this->belongsTo(Formation::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }


}
