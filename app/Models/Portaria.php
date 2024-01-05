<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Portaria extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome_paciente', 'unidade_internacao', 'observacao','parentesco_visitante', 'user_id', 'visitante_id'
    ];

    public function Visitantes(){
        return $this->belongsToMany(Visitante::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
}
