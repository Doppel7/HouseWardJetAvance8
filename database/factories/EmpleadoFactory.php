<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmpleadoFactory extends Factory
{
    protected $model = Empleado::class;

    public function definition()
    {
        return [
			'tipodoc_id' => $this->faker->name,
			'documento' => $this->faker->name,
			'nombre' => $this->faker->name,
			'email' => $this->faker->name,
			'direccion' => $this->faker->name,
			'municipio' => $this->faker->name,
			'fechadenacimiento' => $this->faker->name,
			'telefono' => $this->faker->name,
			'celular' => $this->faker->name,
			'estado' => $this->faker->name,
        ];
    }
}
