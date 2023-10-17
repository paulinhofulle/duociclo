<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reserva;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reserva::create([
            'resdatainicio'      => '2023-10-16',
            'resdatatermino'               => '2023-10-26',
            'ressituacao'            => 1,
            'id'               =>4 ,
            'placodigo'                 => 1,
            'veicodigo' => 2,
        ]);
    }
}
