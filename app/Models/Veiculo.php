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
        'veikm',
        'veisituacao',
        'veiplaca',
        'veicor',
        'veiimagem',
        'lojcodigo',
        'marcodigo'
    ];
}
