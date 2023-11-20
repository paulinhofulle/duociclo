<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        User::create([
            'usunome'                => "Paulo Henrique Fülle",
            'usucpf'                 => '10029170931',
            'usutipo'                => 1,
            'usudatanascimento'      => '2001-08-06',
            'usunumeroendereco'      => '62',
            'password'               => Hash::make('123'),
            'usutelefone'            => '47988061721',
            'email'                  => 'paulohfulle@gmail.com',
            'usucep'                 => '89163467',
            'usurua'                 => 'Rua guido vota',
            'usubairro'              => 'fundo canoas',
            'usucidade'              => 'rio do sul',
            'usuestado'              => 'SC',
            'usucomplementoendereco' => 'casa de madeira',
        ]);

        // para criar registros em massa aleatórios

        //Usuario::factory(5)->create();
    }
}
