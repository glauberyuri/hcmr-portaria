<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Visitante extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome_visitante', 'rg_visitante', 'cpf_visitante'
    ];

    public function visitas()
    {
        return $this->hasMany(Portaria::class);
    }
}
