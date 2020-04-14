<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Ramsey\Uuid\Uuid;
use App\Domain\Products\Models\Product;
use App\Domain\Products\Models\ProductUnit;

$factory->define(Product::class, function (Faker $faker) {
    $unit = factory(ProductUnit::class)->create();

    return [
        'id' => (string) Uuid::uuid4(),
        'product_unit_id' => $unit->id,
        'name' => $faker->words(3, true),
    ];
});
