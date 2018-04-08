<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = [
    	'user_id',
    	'date',
    	'purpose',
    	'performance_report'
    ];
}
