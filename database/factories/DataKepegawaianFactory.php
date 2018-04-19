<?php

use Faker\Generator as Faker;

$factory->define(App\DataKepegawaian::class, function (Faker $faker) {
    $year = [$faker->year, $faker->year];

    return [
        'id_pegawai' => App\Pegawai::pluck('id_user')->random(),
        'id_unit_kerja' => App\UnitKerja::pluck('id_unit_kerja')->random(),
        'id_posisi' => App\Posisi::pluck('id_posisi')->random(),
        'tahun_masuk' => min($year),
        'tahun_keluar' => $faker->boolean($chanceOfGettingTrue = 90) ? max($year) : NULL,
    ];
});
