<?php

use Faker\Generator as Faker;

$factory->define(App\Sertifikat::class, function (Faker $faker) {
    return [
        'id_pegawai' => App\Pegawai::pluck('id_user')->random(),
        'judul' => $faker->jobTitle,
        'lembaga' => $faker->company,
        'tahun_diterbitkan' => $faker->year,
        'catatan' => $faker->paragraph,
    ];
});
