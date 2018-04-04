<?php

use Faker\Generator as Faker;

$factory->define(App\RiwayatPendidikan::class, function (Faker $faker) {
    $strata = ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'];
    $year = [$faker->year, $faker->year];

    return [
        'id_pegawai' => App\Pegawai::pluck('id_user')->random(),
        'nama_institusi' => $faker->company(),
        'strata' => $faker->randomElement($strata),
        'jurusan' => $faker->company(),
        'tahun_masuk' => min($year),
        'tahun_keluar' => max($year),
    ];
});
