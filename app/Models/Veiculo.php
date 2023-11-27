<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model{

    use HasFactory;

    protected $table      = 'tbveiculo';
    protected $primaryKey = 'veicodigo';

    protected $fillable = [
        'veidescricao',
        'veiano',
        'veiquilometragem',
        'veisituacao',
        'veiplaca',
        'veicor',
        'veiimagem',
        'lojcodigo',
        'marcodigo'
    ];

    public function tbloja(){
        return $this->belongsTo(Loja::class, 'lojcodigo', 'lojcodigo');
    }

    public function tbmarca(){
        return $this->belongsTo(Marca::class, 'marcodigo', 'marcodigo');
    }
}
