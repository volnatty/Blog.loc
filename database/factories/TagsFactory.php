<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Tag::class, function (Faker $faker) {
    return [
        'title' => $faker->words(rand(1, 2), true),
    ];
});
