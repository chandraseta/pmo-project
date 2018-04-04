<?php

use Faker\Generator as Faker;

$factory->define(App\DataKepegawaian::class, function (Faker $faker) {
    $year = [$faker->year, $faker->year];

    return [
        'id_pegawai' => App\Pegawai::pluck('id_user')->random(),
        'kompetensi' => $faker->company(),
        'unit_kerja' => $faker->company(),
        'posisi' => $faker->jobTitle(),
        'tahun_masuk' => min($year),
        'tahun_keluar' => $faker->boolean($chanceOfGettingTrue = 90) ? max($year) : NULL,
    ];
});
