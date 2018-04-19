<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_posisi
 * @property string $nama_posisi
 * @property DataKepegawaian[] $dataKepegawaians
 * @property RekomendasiPosisi[] $rekomendasiPosisis
 */
class Posisi extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'posisi';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_posisi';

    /**
     * @var array
     */
    protected $fillable = ['nama_posisi'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dataKepegawaians()
    {
        return $this->hasMany('App\DataKepegawaian', 'id_posisi', 'id_posisi');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rekomendasiPosisis()
    {
        return $this->hasMany('App\RekomendasiPosisi', 'id_posisi', 'id_posisi');
    }
}
