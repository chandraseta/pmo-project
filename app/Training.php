<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_training
 * @property string $nama_training
 * @property RekomendasiTraining[] $rekomendasiTrainings
 */
class Training extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'training';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_training';

    /**
     * @var array
     */
    protected $fillable = ['nama_training'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rekomendasiTrainings()
    {
        return $this->hasMany('App\RekomendasiTraining', 'id_training', 'id_training');
    }
}
