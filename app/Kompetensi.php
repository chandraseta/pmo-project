<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_kompetensi
 * @property int $id_pegawai
 * @property string $tanggal
 * @property float $kognitif_efisiensi_kecerdasan
 * @property float $kognitif_daya_nalar
 * @property float $kognitif_daya_asosiasi
 * @property float $kognitif_daya_analitis
 * @property float $kognitif_daya_antisipasi
 * @property float $kognitif_kemandirian_berpikir
 * @property float $kognitif_fleksibilitas
 * @property float $kognitif_daya_tangkap
 * @property float $kognitif
 * @property float $interaksional_penempatan_diri
 * @property float $interaksional_percaya_diri
 * @property float $interaksional_daya_kooperatif
 * @property float $interaksional_penyesuaian_perasaan
 * @property float $interaksional
 * @property float $emosional_stabilitas_emosi
 * @property float $emosional_toleransi_stres
 * @property float $emosional_pengendalian_diri
 * @property float $emosional_kemantapan_konsentrasi
 * @property float $emosional
 * @property float $sikap_kerja_hasrat_berprestasi
 * @property float $sikap_kerja_daya_tahan
 * @property float $sikap_kerja_keteraturan_kerja
 * @property float $sikap_kerja_pengerahan_energi_kerja
 * @property float $sikap_kerja
 * @property float $manajerial_efektivitas_perencanaan
 * @property float $manajerial_pengorganisasian_pelaksanaan
 * @property float $manajerial_intensitas_pengarahan
 * @property float $manajerial_kekuatan_pengawasan
 * @property float $manajerial
 * @property float $profil_potensi_keberhasilan
 * @property float $profil_potensi_pengembangan_diri
 * @property float $profil_loyalitas_terhadap_tugas
 * @property float $profil_efektivitas_manajerial
 * @property float $profil
 * @property char $indeks
 * @property Pegawai $pegawai
 */
class Kompetensi extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'kompetensi';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_kompetensi';

    /**
     * @var array
     */
    protected $fillable = [
        'id_pegawai',
        'tanggal',
        'kognitif_efisiensi_kecerdasan',
        'kognitif_daya_nalar',
        'kognitif_daya_asosiasi',
        'kognitif_daya_analitis',
        'kognitif_daya_antisipasi',
        'kognitif_kemandirian_berpikir',
        'kognitif_fleksibilitas',
        'kognitif_daya_tangkap',
        'interaksional_penempatan_diri',
        'interaksional_percaya_diri',
        'interaksional_daya_kooperatif',
        'interaksional_penyesuaian_perasaan',
        'emosional_stabilitas_emosi',
        'emosional_toleransi_stres',
        'emosional_pengendalian_diri',
        'emosional_kemantapan_konsentrasi',
        'sikap_kerja_hasrat_berprestasi',
        'sikap_kerja_daya_tahan',
        'sikap_kerja_keteraturan_kerja',
        'sikap_kerja_pengerahan_energi_kerja',
        'manajerial_efektivitas_perencanaan',
        'manajerial_pengorganisasian_pelaksanaan',
        'manajerial_intensitas_pengarahan',
        'manajerial_kekuatan_pengawasan'
    ];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'id_pegawai', 'id_user');
    }
}
