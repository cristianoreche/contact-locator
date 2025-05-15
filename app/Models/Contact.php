<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'cpf',
        'phone',
        'cep',
        'state',
        'city',
        'street',
        'number',
        'complement',
        'bairro',
        'latitude', 
        'longitude',
    ];

    /**
     * Relacionamento com o usuário (dono do contato)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
