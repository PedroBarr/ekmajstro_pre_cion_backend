<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipoPermiso>
 */
class TipoPermisoFactory extends Factory
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
            "diminutivo" => "tp".$this->faker->numberBetween(19,99)
        ];
    }
}
