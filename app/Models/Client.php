<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'domaine',
        'occupation',
        'created_at',
        'updated_at'
    ];

     public function formations(): HasMany{
        return $this->hasMany(Formation_client::class, 'client_id');
    }
}
