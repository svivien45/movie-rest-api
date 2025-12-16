<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Director;
use App\Models\Studio;
use App\Models\Movie;

class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'categories_id' => Category::factory(),
            'description' => $this->faker->paragraph(),
            'pic_path' => $this->faker->imageUrl(640, 480, 'movies', true),
            'length' => $this->faker->numberBetween(60, 180) . ' min',
            'release_date' => $this->faker->date(),
            'director_id' => Director::factory(),
            'studio_id' => Studio::factory(),
        ];
    }
}
