<?php

namespace Database\Factories;

use App\Models\Categoriaproveedore;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoriaproveedoreFactory extends Factory
{
    protected $model = Categoriaproveedore::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'estado' => $this->faker->name,
        ];
    }
}
