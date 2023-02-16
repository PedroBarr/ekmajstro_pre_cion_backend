<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipoRecurso>
 */
class TipoRecursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "nombre" => $this->faker->name,
            "descripcion"=> $this->faker->text,
            "diminutivo" => "tr".$this->faker->numberBetween(19,99)
        ];
    }
}
