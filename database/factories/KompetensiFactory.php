<?php

use Faker\Generator as Faker;

function randomScore($faker) {
    return $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 6);
}

$factory->define(App\Kompetensi::class, function (Faker $faker) {
    return [
        'id_pegawai' => App\Pegawai::pluck('id_user')->random(),
        'tanggal' => $faker->date,
        'kognitif_efisiensi_kecerdasan' => randomScore($faker),
        'kognitif_daya_nalar' => randomScore($faker),
        'kognitif_daya_asosiasi' => randomScore($faker),
        'kognitif_daya_analitis' => randomScore($faker),
        'kognitif_daya_antisipasi' => randomScore($faker),
        'kognitif_kemandirian_berpikir' => randomScore($faker),
        'kognitif_fleksibilitas' => randomScore($faker),
        'kognitif_daya_tangkap' => randomScore($faker),
        'interaksional_penempatan_diri' => randomScore($faker),
        'interaksional_percaya_diri' => randomScore($faker),
        'interaksional_daya_kooperatif' => randomScore($faker),
        'interaksional_penyesuaian_perasaan' => randomScore($faker),
        'emosional_stabilitas_emosi' => randomScore($faker),
        'emosional_toleransi_stres' => randomScore($faker),
        'emosional_pengendalian_diri' => randomScore($faker),
        'emosional_kemantapan_konsentrasi' => randomScore($faker),
        'sikap_kerja_hasrat_berprestasi' => randomScore($faker),
        'sikap_kerja_daya_tahan' => randomScore($faker),
        'sikap_kerja_keteraturan_kerja' => randomScore($faker),
        'sikap_kerja_pengerahan_energi_kerja' => randomScore($faker),
        'manajerial_efektivitas_perencanaan' => randomScore($faker),
        'manajerial_pengorganisasian_pelaksanaan' => randomScore($faker),
        'manajerial_intensitas_pengarahan' => randomScore($faker),
        'manajerial_kekuatan_pengawasan' => randomScore($faker),
    ];
});
