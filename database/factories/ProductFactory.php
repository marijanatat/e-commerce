<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        "name"=>$faker->sentence,
        "description"=>$faker->paragraph,
        "slug"=>$faker->word,
        "details"=>$faker->sentence,
        'price'=>$faker->random_int,
       
    ];
});
