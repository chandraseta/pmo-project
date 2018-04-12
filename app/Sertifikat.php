<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_sertifikat
 * @property int $id_pegawai
 * @property string $judul
 * @property string $lembaga
 * @property string $tahun_diterbitkan
 * @property string $catatan
 * @property string $created_at
 * @property string $updated_at
 * @property Pegawai $pegawai
 */
class Sertifikat extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sertifikat';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_sertifikat';

    /**
     * @var array
     */
    protected $fillable = ['id_pegawai', 'judul', 'lembaga', 'tahun_diterbitkan', 'catatan'];

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
        return $this->belongsTo('App\Pegawai', 'id_pegawai', 'id_user');
    }
}
