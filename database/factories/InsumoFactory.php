<?php

namespace Database\Factories;

use App\Models\Insumo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InsumoFactory extends Factory
{
    protected $model = Insumo::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'cantidad' => $this->faker->name,
			'categoria_id' => $this->faker->name,
			'estado' => $this->faker->name,
        ];
    }
}
