<?php

use Faker\Generator as Faker;

$factory->define(App\RekomendasiTraining::class, function (Faker $faker) {
    return [
        'id_pegawai' => App\Pegawai::pluck('id_user')->random(),
        'id_training' => App\Training::pluck('id_training')->random(),
    ];
});
