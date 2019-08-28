<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Booking;
use Faker\Generator as Faker;

$factory->define(Booking::class, function (Faker $faker) {
    return [
        'from' => $faker->city,
        'to' => $faker->city,
        'amount' => $faker->randomNumber(),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});
