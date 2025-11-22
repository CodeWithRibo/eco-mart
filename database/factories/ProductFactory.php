<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {

        return [
            'product_name' => $this->faker->randomElement([
                'Tomatoes', 'Sting', 'Bananas'
            ]),

            'product_image' => 'photos/default.jpg',

            'category' => $this->faker->randomElement([
                'Vegetables', 'Fruits', 'Bakery', 'Dairy', 'Beverage'
            ]),

            'price' => $this->faker->randomFloat(2, 10, 500),

            'stock' => $this->faker->numberBetween(0, 200),

            'created_at' => now(),
            'updated_at' => now(),
        ];

    }
}
