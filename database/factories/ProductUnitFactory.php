<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Ramsey\Uuid\Uuid;
use App\Domain\Products\Models\ProductUnit;

$factory->define(ProductUnit::class, function () {
    return [
        'id' => (string) Uuid::uuid4(),
        'base' => 1,
        'step' => 1,
        'price' => rand(100, 10000),
        'type' => ProductUnit::PIECE_TYPE,
    ];
});
