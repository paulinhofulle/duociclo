<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model {

    use HasFactory;

    protected $table      = 'tbreserva';
    protected $primaryKey = 'rescodigo';

    protected $fillable = [
        'resdatainicio',
        'resdatatermino',
        'ressituacao',
        'veicodigo',
        'usucodigo',
        'placodigo'
    ];

    public function tbveiculo(){
        return $this->belongsTo(Veiculo::class, 'veicodigo', 'veicodigo');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function tbplano(){
        return $this->belongsTo(Plano::class, 'placodigo', 'placodigo');
    }
    
}
