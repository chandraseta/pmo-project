<?php

use Faker\Generator as Faker;

$factory->define(App\Training::class, function (Faker $faker) {
    return [
        'nama_training' => $faker->sentence($nbWords = 3),
        'penyelenggara' => $faker->company,
        'bidang' => $faker->jobTitle
    ];
});
