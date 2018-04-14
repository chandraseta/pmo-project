<?php

use Faker\Generator as Faker;

$factory->define(App\Kinerja::class, function (Faker $faker) {
    $a = new StdClass();
    $a->report = $faker->paragraph($nbSentences = 3, $variableNbSentences = true);

    return [
        'id_pegawai' => App\Pegawai::pluck('id_user')->random(),
        'tahun' => $faker->year,
        'semester' => $faker->boolean,
        'nilai' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 6),
        'catatan' => $faker->paragraph,
    ];
});
