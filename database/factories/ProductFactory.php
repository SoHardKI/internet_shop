<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'article' => strtoupper(Str::random(rand(2,3))) . rand(10, 1000),
        'price' => rand(10000, 50000),
        'description' => $faker->text(500),
        'image_url' => 'images/product_' . rand(1, 12) . '.jpg',
        'category_id' => Category::inRandomOrder()->first()->id
    ];
});
