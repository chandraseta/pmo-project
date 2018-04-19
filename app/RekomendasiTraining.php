<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_rekomendasi_training
 * @property int $id_pegawai
 * @property int $id_training
 * @property Pegawai $pegawai
 * @property Training $training
 */
class RekomendasiTraining extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'rekomendasi_training';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_rekomendasi_training';

    /**
     * @var array
     */
    protected $fillable = ['id_pegawai', 'id_training'];

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
    public function training()
    {
        return $this->belongsTo('App\Training', 'id_training', 'id_training');
    }
}
