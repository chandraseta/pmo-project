<?php

use Faker\Generator as Faker;

$factory->define(App\Kinerja::class, function (Faker $faker) {
    $a = new StdClass();
    $a->report = $faker->paragraph($nbSentences = 3, $variableNbSentences = true);

    return [
        'id_pegawai' => App\Pegawai::pluck('id_user')->random(),
        'tanggal' => $faker->date,
        'laporan_kinerja' => json_encode($a)
    ];
});