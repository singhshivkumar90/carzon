<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\ToDo;
use Faker\Generator as Faker;

$factory->define(ToDo::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence,
        'is_completed' => $faker->boolean(50),
        'completed_at' => $faker->dateTime(),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});
