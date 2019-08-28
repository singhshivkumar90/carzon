<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Ticket;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});
