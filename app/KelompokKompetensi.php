<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_kelompok_kompetensi
 * @property string $nama_kelompok_kompetensi
 * @property Pegawai[] $pegawais
 */
class KelompokKompetensi extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'kelompok_kompetensi';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_kelompok_kompetensi';

    /**
     * @var array
     */
    protected $fillable = ['nama_kelompok_kompetensi'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pegawais()
    {
        return $this->hasMany('App\Pegawai', 'id_kelompok_kompetensi', 'id_kelompok_kompetensi');
    }
}
