<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_unit_kerja
 * @property string $nama_unit_kerja
 * @property DataKepegawaian[] $dataKepegawaians
 * @property RekomendasiPosisi[] $rekomendasiPosisis
 */
class UnitKerja extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'unit_kerja';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_unit_kerja';

    /**
     * @var array
     */
    protected $fillable = ['nama_unit_kerja'];

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
        return $this->hasMany('App\DataKepegawaian', 'id_unit_kerja', 'id_unit_kerja');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rekomendasiPosisis()
    {
        return $this->hasMany('App\RekomendasiPosisi', 'id_unit_kerja', 'id_unit_kerja');
    }
}
