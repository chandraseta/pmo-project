<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_riwayat_pendidikan
 * @property int $id_pegawai
 * @property string $nama_institusi
 * @property string $strata
 * @property string $jurusan
 * @property string $tahun_masuk
 * @property string $tahun_keluar
 * @property Pegawai $pegawai
 */
class RiwayatPendidikan extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'riwayat_pendidikan';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_riwayat_pendidikan';

    /**
     * @var array
     */
    protected $fillable = ['id_pegawai', 'nama_institusi', 'strata', 'jurusan', 'tahun_masuk', 'tahun_keluar'];

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
