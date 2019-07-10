<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\PackSeason;
use Faker\Generator as Faker;

$factory->define(PackSeason::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'weight' => 10,
    ];
});
