<?php

namespace Database\Factories;

use App\Models\Categoriainsumo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoriainsumoFactory extends Factory
{
    protected $model = Categoriainsumo::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'estado' => $this->faker->name,
        ];
    }
}
