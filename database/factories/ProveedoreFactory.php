<?php

namespace Database\Factories;

use App\Models\Proveedore;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProveedoreFactory extends Factory
{
    protected $model = Proveedore::class;

    public function definition()
    {
        return [
			'tipodoc_id' => $this->faker->name,
			'documento' => $this->faker->name,
			'nombre' => $this->faker->name,
			'email' => $this->faker->name,
			'direccion' => $this->faker->name,
			'celular' => $this->faker->name,
			'categoria_id' => $this->faker->name,
			'estado' => $this->faker->name,
        ];
    }
}
