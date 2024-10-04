<?php

namespace Database\Factories;

use App\Models\category;
use App\Models\store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class productFactory extends Factory
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
            'image' => $this->faker->imageUrl(600 , 600),
            'price' => $this->faker->randomFloat(1 , 1 ,499),
            'compare_price' => $this->faker->randomFloat(1 , 500 ,999),
            'features' => rand(0 , 1),
            'category_id'=> category::inRandomOrder()->first()->id,
            'store_id'=> store::inRandomOrder()->first()->id,
        ];
    }
}
