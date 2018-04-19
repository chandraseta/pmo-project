<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_kinerja
 * @property int $id_pegawai
 * @property string $tahun
 * @property boolean $semester
 * @property float $nilai
 * @property string $catatan
 * @property Pegawai $pegawai
 */
class Kinerja extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'kinerja';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_kinerja';

    /**
     * @var array
     */
    protected $fillable = ['id_pegawai', 'tahun', 'semester', 'nilai', 'catatan'];

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
