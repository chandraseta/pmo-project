<?php

use Faker\Generator as Faker;

$factory->define(App\RiwayatPekerjaan::class, function (Faker $faker) {
    $year = [$faker->year, $faker->year];

    return [
        'id_pegawai' => App\Pegawai::pluck('id_user')->random(),
        'nama_institusi' => $faker->company(),
        'posisi' => $faker->jobTitle(),
        'tahun_masuk' => min($year),
        'tahun_keluar' => max($year),
    ];
});
