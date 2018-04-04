<?php

use Faker\Generator as Faker;

$factory->define(App\Admin::class, function (Faker $faker) {
    return [
        'id_user' => $faker->unique()->numberBetween(1, App\User::count()),
    ];
});
