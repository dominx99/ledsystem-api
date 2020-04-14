<?php

use Illuminate\Database\Seeder;
use App\Domain\Categories\Models\Category;
use App\Domain\Products\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        factory(Product::class, 1000)->create()->each(function (Product $product) {
            $product->categories()->attach(Category::inRandomOrder()->first());
        });
    }
}
