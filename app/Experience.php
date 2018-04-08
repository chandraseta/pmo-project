<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
    	'user_id',
    	'institution',
    	'position',
    	'start_year',
    	'end_year'
    ];
}
