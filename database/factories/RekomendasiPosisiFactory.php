<?php

use Faker\Generator as Faker;

$factory->define(App\RekomendasiPosisi::class, function (Faker $faker) {
    return [
        'id_pegawai' => App\Pegawai::pluck('id_user')->random(),
        'id_posisi' => App\Posisi::pluck('id_posisi')->random(),
    ];
});
