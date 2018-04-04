<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_user
 * @property string $nama
 * @property string $nip
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property User $user
 * @property DataKepegawaian[] $dataKepegawaians
 * @property Kinerja[] $kinerjas
 * @property RekomendasiPosisi[] $rekomendasiPosisis
 * @property RekomendasiTraining[] $rekomendasiTrainings
 * @property RiwayatPekerjaan[] $riwayatPekerjaans
 * @property RiwayatPendidikan[] $riwayatPendidikans
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
    protected $fillable = ['nama', 'nip', 'tempat_lahir', 'tanggal_lahir'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

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
}
