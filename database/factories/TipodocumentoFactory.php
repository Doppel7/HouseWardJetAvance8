<?php

namespace Database\Factories;

use App\Models\Tipodocumento;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TipodocumentoFactory extends Factory
{
    protected $model = Tipodocumento::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
        ];
    }
}
