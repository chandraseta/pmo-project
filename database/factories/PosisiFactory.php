<?php

use Faker\Generator as Faker;

$factory->define(App\Posisi::class, function (Faker $faker) {
    $a = new StdClass();
    $a->name = $faker->name;

    return [
        'nama_posisi' => $faker->jobTitle,
        'kompetensi' => $faker->company,
        'unit_kerja' => $faker->company,
        'kinerja' => json_encode($a)
    ];
});
