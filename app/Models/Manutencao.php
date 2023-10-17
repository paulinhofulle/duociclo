<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manutencao extends Model {

    use HasFactory;

    protected $table      = 'tbmanutencao';
    protected $primaryKey = 'mancodigo';

    protected $fillable = [
        'manvalor',
        'mansituacao',
        'mandatainicio',
        'mandatatermino',
        'manobservacao',
        'mandescricao',
        'veicodigo'
    ];

    public function tbveiculo(){
        return $this->belongsTo(Veiculo::class, 'veicodigo', 'veicodigo');
    }
}
