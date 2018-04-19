<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_user
 * @property int $id_pengubah
 * @property string $nama
 * @property string $nip
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $no_telp
 * @property string $kelompok_kompetensi
 * @property string $unit_kerja
 * @property string $posisi
 * @property string $tahun_masuk_kerja
 * @property string $pendidikan_terakhir
 * @property Pegawai $pegawai
 * @property User $user
 */
class DenormalizedPegawai extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'denormalized_pegawai';

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
    protected $fillable = [];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = true;

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
}
