<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\store>
 */
class storeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2 , true),
            'description' => $this->faker->sentence(15),
            'slug' => Str::slug($this->faker->words(2 , true)),
            'logo_image' => $this->faker->imageUrl(300 , 300),
            'cover_image' => $this->faker->imageUrl(800 , 600),
        ];
    }
}
