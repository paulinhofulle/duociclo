<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loja>
 */
class LojaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lojnome'                => $this->faker->unique()->word,
            'lojcnpj'                => $this->faker->unique()->numberBetween(14),
            'lojnumeroendereco'      => $this->faker->numberBetween(1, 5),
            'lojtelefone'            => $this->faker->numberBetween(11),
            'lojemail'               => $this->faker->word.'@gmail.com',
            'lojcep'                 => $this->faker->numberBetween(8,8),
            'lojcomplementoendereco' => $this->faker->text,
        ];
    }
}
