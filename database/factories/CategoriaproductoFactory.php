<?php

namespace Database\Factories;

use App\Models\Categoriaproducto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoriaproductoFactory extends Factory
{
    protected $model = Categoriaproducto::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'estado' => $this->faker->name,
        ];
    }
}
