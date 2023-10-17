<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usunome'                => $this->faker->unique()->word,
            'usucpf'                 => $this->faker->unique()->numberBetween(11),
            'usutipo'                => 3,
            'usudatanascimento'      => $this->faker->date,
            'usunumeroendereco'      => $this->faker->numberBetween(1, 5),
            'ususenha'               => $this->faker->text,
            'usutelefone'            => $this->faker->numberBetween(11),
            'usuemail'               => $this->faker->text,
            'usucep'                 => $this->faker->numberBetween(8,8),
            'usucomplementoendereco' => $this->faker->text
        ];
    }
}
