<?php

use Faker\Generator as Faker;

$factory->define(App\Kompetensi::class, function (Faker $faker) {
    $randomScore = static function() use ($faker) {
        return $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 6);
    };

    return [
        'id_pegawai' => App\Pegawai::pluck('id_user')->random(),
        'tujuan' => $faker->sentence,
        'tanggal' => $faker->date,
        'kognitif_efisiensi_kecerdasan' => $randomScore(),
        'kognitif_daya_nalar' => $randomScore(),
        'kognitif_daya_asosiasi' => $randomScore(),
        'kognitif_daya_analitis' => $randomScore(),
        'kognitif_daya_antisipasi' => $randomScore(),
        'kognitif_kemandirian_berpikir' => $randomScore(),
        'kognitif_fleksibilitas' => $randomScore(),
        'kognitif_daya_tangkap' => $randomScore(),
        'interaksional_penempatan_diri' => $randomScore(),
        'interaksional_percaya_diri' => $randomScore(),
        'interaksional_daya_kooperatif' => $randomScore(),
        'interaksional_penyesuaian_perasaan' => $randomScore(),
        'emosional_stabilitas_emosi' => $randomScore(),
        'emosional_toleransi_stres' => $randomScore(),
        'emosional_pengendalian_diri' => $randomScore(),
        'emosional_kemantapan_konsentrasi' => $randomScore(),
        'sikap_kerja_hasrat_berprestasi' => $randomScore(),
        'sikap_kerja_daya_tahan' => $randomScore(),
        'sikap_kerja_keteraturan_kerja' => $randomScore(),
        'sikap_kerja_pengerahan_energi_kerja' => $randomScore(),
        'manajerial_efektivitas_perencanaan' => $randomScore(),
        'manajerial_pengorganisasian_pelaksanaan' => $randomScore(),
        'manajerial_intensitas_pengarahan' => $randomScore(),
        'manajerial_kekuatan_pengawasan' => $randomScore(),
    ];
});
