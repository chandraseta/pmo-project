<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at',
    ];

    public static function generatePassword() {
        return bcrypt(str_random(30));
    }

    public static function sendWelcomeEmail($token) {

    }

    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetPassword($token));
    }
}
