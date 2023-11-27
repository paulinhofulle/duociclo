<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Loja;

class LojaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Loja::create([
            'lojnome'                => "Motos Neno",
            'lojcnpj'                => '38809161000101',
            'lojnumeroendereco'      => 2,
            'lojtelefone'            => '47223654789',
            'lojemail'               => 'motosneno@gmail.com',
            'lojcep'                 => '89163468',
            'lojrua'                 => 'teste',
            'lojbairro'                 => 'teste',
            'lojcidade'                 => 'teste',
            'lojestado'                 => 'AC',
            'lojcomplementoendereco' => 'loja no centro de rds',
        ]);
        //Loja::factory(1)->create();
    }
}
