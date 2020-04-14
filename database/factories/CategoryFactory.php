<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Domain\Categories\Models\Category;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->unique()->words(rand(1, 3), true);

    return [
        'id' => (string) Uuid::uuid4(),
        'name' => $name,
        'slug' => Str::slug($name, '-'),
    ];
});
