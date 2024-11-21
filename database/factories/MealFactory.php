<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name(),
            'description'=>$this->faker->text(),
            'price'=>$this->faker->randomFloat(2,0,1000),
            'offer_price'=>$this->faker->randomFloat(2,0,1000),
            'restaurant_id'=> Restaurant::inRandomOrder()->value('id'),
            'preparation_time'=>$this->faker->time('H:i:s'),
        ];
    }
}
