<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_rekomendasi_posisi
 * @property int $id_pegawai
 * @property int $id_posisi
 * @property Pegawai $pegawai
 * @property Posisi $posisi
 */
class RekomendasiPosisi extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'rekomendasi_posisi';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_rekomendasi_posisi';

    /**
     * @var array
     */
    protected $fillable = ['id_pegawai', 'id_posisi'];

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
}
