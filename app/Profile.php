<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'nip',
        'birth_place',
        'birth_date',
    ];
}
