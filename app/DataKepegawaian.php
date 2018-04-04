<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_data_kepegawaian
 * @property int $id_pegawai
 * @property string $kompetensi
 * @property string $unit_kerja
 * @property string $posisi
 * @property string $tahun_masuk
 * @property string $tahun_keluar
 * @property Pegawai $pegawai
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
    protected $fillable = ['id_pegawai', 'kompetensi', 'unit_kerja', 'posisi', 'tahun_masuk', 'tahun_keluar'];

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
