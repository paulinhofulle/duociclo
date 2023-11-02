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
            'resdatainicio'      => '2023-11-02',
            'resdatatermino'               => '2023-11-30',
            'ressituacao'            => 1,
            'usucodigo'               =>3 ,
            'placodigo'                 => 1,
            'veicodigo' => 2,
        ]);
    }
}
