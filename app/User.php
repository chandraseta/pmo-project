<?php

namespace App;


use App\Notification\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
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

    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetPassword($token));
    }

    public function isAdmin() {
        return !is_null(Admin::find($this->id));
    }

    public function isPMO() {
        return !is_null(PMO::find($this->id));
    }

    public function isPegawai() {
        return !is_null(Pegawai::find($this->id));
    }

    public function isPegawaiOnly() {
        return ($this->isPegawai() and !$this->isPMO() and !$this->isAdmin());
    }
}
