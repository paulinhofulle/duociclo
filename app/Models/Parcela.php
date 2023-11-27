<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    use HasFactory;

    protected $table = 'tbparcela';
    protected $primaryKey = ['parsequencia', 'alucodigo'];
    public $incrementing = false; // Desativa o incremento automático, já que não temos uma única coluna autoincrementável


    protected $fillable = [
        'parsequencia',
        'alucodigo',
        'parsituacao',
        'parvalor',
        'pardatavencimento',
    ];

    public function tbaluguel()
    {
        return $this->belongsTo(Aluguel::class, 'alucodigo', 'alucodigo');
    }
}

