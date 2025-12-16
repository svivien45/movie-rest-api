<?php

namespace Database\Factories;

use App\Models\Studio;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudioFactory extends Factory
{
    protected $model = Studio::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
        ];
    }
}
