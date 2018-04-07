<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
    	'user_id',
    	'degree',
    	'institution',
    	'major',
    	'start_year',
    	'end_year'
    ]
}
