<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_user
 * @property int $id_kelompok_kompetensi
 * @property int $id_pengubah
 * @property string $nama
 * @property string $nip
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $no_telp
 * @property string $created_at
 * @property string $updated_at
 * @property KelompokKompetensi $kelompokKompetensi
 * @property Pegawai $pegawai
 * @property User $user
 * @property DataKepegawaian[] $dataKepegawaians
 * @property Kinerja[] $kinerjas
 * @property Kompetensi[] $kompetensis
 * @property RekomendasiPosisi[] $rekomendasiPosisis
 * @property RekomendasiTraining[] $rekomendasiTrainings
 * @property RiwayatPekerjaan[] $riwayatPekerjaans
 * @property RiwayatPendidikan[] $riwayatPendidikans
 * @property Sertifikat[] $sertifikats
 */
class Pegawai extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pegawai';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_user';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['id_user', 'id_kelompok_kompetensi', 'id_pengubah', 'nama', 'nip', 'tempat_lahir', 'tanggal_lahir', 'no_telp', 'created_at', 'updated_at'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kelompokKompetensi()
    {
        return $this->belongsTo('App\KelompokKompetensi', 'id_kelompok_kompetensi', 'id_kelompok_kompetensi');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'id_pengubah', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dataKepegawaians()
    {
        return $this->hasMany('App\DataKepegawaian', 'id_pegawai', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kinerjas()
    {
        return $this->hasMany('App\Kinerja', 'id_pegawai', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kompetensis()
    {
        return $this->hasMany('App\Kompetensi', 'id_pegawai', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rekomendasiPosisis()
    {
        return $this->hasMany('App\RekomendasiPosisi', 'id_pegawai', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rekomendasiTrainings()
    {
        return $this->hasMany('App\RekomendasiTraining', 'id_pegawai', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function riwayatPekerjaans()
    {
        return $this->hasMany('App\RiwayatPekerjaan', 'id_pegawai', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function riwayatPendidikans()
    {
        return $this->hasMany('App\RiwayatPendidikan', 'id_pegawai', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sertifikats()
    {
        return $this->hasMany('App\Sertifikat', 'id_pegawai', 'id_user');
    }
}
