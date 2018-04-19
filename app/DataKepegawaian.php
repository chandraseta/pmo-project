<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_data_kepegawaian
 * @property int $id_pegawai
 * @property int $id_unit_kerja
 * @property int $id_posisi
 * @property string $tahun_masuk
 * @property string $tahun_keluar
 * @property Pegawai $pegawai
 * @property Posisi $posisi
 * @property UnitKerja $unitKerja
 */
class DataKepegawaian extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'data_kepegawaian';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_data_kepegawaian';

    /**
     * @var array
     */
    protected $fillable = ['id_pegawai', 'id_unit_kerja', 'id_posisi', 'tahun_masuk', 'tahun_keluar'];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posisi()
    {
        return $this->belongsTo('App\Posisi', 'id_posisi', 'id_posisi');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unitKerja()
    {
        return $this->belongsTo('App\UnitKerja', 'id_unit_kerja', 'id_unit_kerja');
    }
}
