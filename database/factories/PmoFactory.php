<?php

use Faker\Generator as Faker;

$factory->define(App\PMO::class, function (Faker $faker) {
    return [
        'id_user' => $faker->unique()->numberBetween(1, App\User::count()),
    ];
});
