<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluguel extends Model{

    use HasFactory;

    protected $table      = 'tbaluguel';
    protected $primaryKey = 'alucodigo';

    protected $fillable = [
        'aludatainicio',
        'aludatatermino',
        'alusituacao',
        'veicodigo',
        'usucodigo',
        'placodigo'
    ];

    public function tbveiculo(){
        return $this->belongsTo(Veiculo::class, 'veicodigo', 'veicodigo');
    }

    public function user(){
        return $this->belongsTo(User::class, 'usucodigo', 'id');
    }

    public function tbplano(){
        return $this->belongsTo(Plano::class, 'placodigo', 'placodigo');
    }
}
