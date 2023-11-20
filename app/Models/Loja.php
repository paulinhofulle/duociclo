<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    use HasFactory;

    protected $table      = 'tbloja';
    protected $primaryKey = 'lojcodigo';

    protected $fillable = [
        'lojnome'               ,
        'lojcnpj'               ,
        'lojnumeroendereco'     ,
        'lojtelefone'           ,
        'lojemail'              ,
        'lojcep'                ,
        'lojrua'                ,
        'lojbairro'             ,
        'lojcidade'             ,
        'lojestado'             ,
        'lojcomplementoendereco',
    ];
}
