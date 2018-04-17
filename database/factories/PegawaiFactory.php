<?php

use Faker\Generator as Faker;

$factory->define(App\Pegawai::class, function (Faker $faker) {
    $id = $faker->unique()->numberBetween(1, App\User::count());
    return [
        'id_user' => $id,
        'nama' => $faker->name,
        'nip' => $faker->unique()->regexify('\d{18}'),
        'tempat_lahir' => $faker->city(),
        'tanggal_lahir' => $faker->date(),
        'no_telp' => $faker->phoneNumber(),
    ];
});
