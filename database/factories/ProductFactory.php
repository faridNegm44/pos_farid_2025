<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Back\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Back\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition()
    {
        return [
            'shortCode' => $this->faker->unique()->word,
            'natCode' => $this->faker->unique()->numerify('##########'),
            'nameAr' => $this->faker->word,
            'nameEn' => $this->faker->word,
            'store' => $this->faker->numberBetween(1, 10),
            'company' => $this->faker->numberBetween(1, 10),
            'category' => $this->faker->numberBetween(1, 10),
            'stockAlert' => $this->faker->numberBetween(10, 100),
            'divisible' => $this->faker->randomElement(['1', '0']),
            'sellPrice' => $this->faker->randomFloat(2, 1, 1000),
            'purchasePrice' => $this->faker->randomFloat(2, 1, 1000),
            'discountPercentage' => $this->faker->randomFloat(2, 0, 100),
            'tax' => $this->faker->randomFloat(2, 0, 20),
            'firstPeriodCount' => $this->faker->numberBetween(0, 100),
            'bigUnit' => $this->faker->numberBetween(1, 10),
            'smallUnit' => $this->faker->numberBetween(1, 10),
            'smallUnitPrice' => $this->faker->randomFloat(2, 1, 100),
            'smallUnitNumbers' => $this->faker->numberBetween(1, 100),
            'max_sale_quantity' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['1', '0']),
            'image' => $this->faker->imageUrl(),
            'desc' => $this->faker->sentence,
            'offerDiscountStatus' => $this->faker->randomElement(['1', '0']),
            'offerDiscountPercentage' => $this->faker->randomFloat(2, 0, 100),
            'offerStart' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'offerEnd' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
