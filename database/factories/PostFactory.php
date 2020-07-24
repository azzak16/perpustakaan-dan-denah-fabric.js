<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(post::class, function (Faker $faker) {
    return [
      'user_id' => $faker->numberBetween($min = 1, $max = 5),
      'title' => $faker->sentence(),
      'slug' => Str::slug($faker->sentence()),
      'content' => $faker->paragraph(15),
    ];
});
