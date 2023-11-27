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
            'usunome'                => "Administrador",
            'usucpf'                 => '99999999999',
            'usutipo'                => 1,
            'usudatanascimento'      => '2001-01-01',
            'usunumeroendereco'      => '00',
            'password'               => Hash::make('admin'),
            'usutelefone'            => '99999999999',
            'email'                  => 'admin@gmail.com',
            'usucep'                 => '89163467',
            'usurua'                 => 'Rua guido vota',
            'usubairro'              => 'fundo canoas',
            'usucidade'              => 'rio do sul',
            'usuestado'              => 'SC',
            'usucomplementoendereco' => '-',
        ]);

        // para criar registros em massa aleatórios

        //Usuario::factory(5)->create();
    }
}
