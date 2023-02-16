<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recurso>
 */
class RecursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $tipo_recurso_id = \App\Models\TipoRecurso::all()->random()->id;
        $tipo_permiso_id = \App\Models\TipoPermiso::all()->random()->id;

        return [
            "nombre" => $this->faker->name,
            "descripcion" => $this->faker->text,
            "diminutivo" => "url".$this->faker->numberBetween(19,99),
            "tipo_recurso_id" => $tipo_recurso_id,
            "tipo_permiso_id" => $tipo_permiso_id
        ];
    }
}
