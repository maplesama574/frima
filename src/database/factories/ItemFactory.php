<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), 
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(), 
            'price' => $this->faker->numberBetween(100, 10000),
            'image_path' => 'items/sample.png',
            'condition'  => '状態が悪い',
            'is_sold' => false,
            
        ];
    }

    public function sold()
    {
        return $this->state([
            'is_sold' => true,
        ]);
    }
}
