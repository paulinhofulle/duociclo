<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model{

    use HasFactory;

    protected $table      = 'tbparcela';
    protected $primaryKey = 'parsequencia';

    protected $fillable = [
        'parsequencia',
        'alucodigo',
        'parsituacao',
        'parvalor',
        'pardatavalidade',
    ];

    public function tbaluguel(){
        return $this->belongsTo(Aluguel::class, 'alucodigo', 'alucodigo');
    }
}
