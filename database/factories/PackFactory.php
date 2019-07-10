<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Pack;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(Pack::class, function (Faker $faker) {

    $file = UploadedFile::fake()->image('pack.png', 600, 600);

    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'pack_season_id' => function () {
            return factory(App\PackSeason::class)->create()->id;
        },
        'name' => $faker->name,
        'image' => $file->store('packs', ['disk' => 'public']),
        'heart_count' => $this->faker->numberBetween(0,4000),
        'visible_item_count' => 10,
        'visible_ounces' => 10,
        'visible_cost' => 100,
        'is_visible' => $this->faker->boolean($chanceOfGettingTrue = 90),

    ];
});
