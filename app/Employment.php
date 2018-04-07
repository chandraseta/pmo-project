<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    protected $fillable = [
    	'user_id',
    	'competency',
    	'unit',
    	'position',
    	'start_year',
    	'end_year'
    ]
}
