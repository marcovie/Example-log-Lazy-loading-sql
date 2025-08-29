<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Price;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Laptop', 'description' => 'High-performance laptop for professionals'],
            ['name' => 'Smartphone', 'description' => 'Latest flagship smartphone with advanced features'],
            ['name' => 'Tablet', 'description' => 'Portable tablet for productivity and entertainment'],
            ['name' => 'Desktop Computer', 'description' => 'Powerful desktop computer for gaming and work'],
            ['name' => 'Headphones', 'description' => 'Premium wireless headphones with noise cancellation'],
        ];

        foreach ($products as $productData) {
            $product = Product::create($productData);

            for ($i = 1; $i <= 50; $i++) {
                Price::create([
                    'product_id' => $product->id,
                    'price' => fake()->randomFloat(2, 99.99, 2999.99),
                    'currency' => fake()->randomElement(['USD', 'EUR', 'GBP']),
                    'effective_date' => Carbon::now()->subDays(rand(0, 365)),
                ]);
            }
        }
    }
}
