<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Notification\WelcomeEmail;
use App\Pegawai;
use App\PMO;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/pages/admin/adduser';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {}

    /**
     * Override register to disable auto login
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nip' => 'required|string|unique:pegawai',
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->first('email')) {
                session()->flash('alert-danger', 'Email telah terdaftar');
            }
            else if ($validator->errors()->first('nip')) {
                session()->flash('alert-danger', 'NIP/Nopeg telah terdaftar');
            }
        }
        else {
            if ($request->has('isAdmin') or $request->has('isPMO') or $request->has('isPegawai')) {
                event(new Registered($user = $this->create($request->all())));
                session()->flash('alert-success', 'Pengguna berhasil ditambahkan');
                if ($this->registered($request, $user)) {
                    session()->flash('alert-success', 'Pengguna berhasil ditambahkan');
                }
                else {
                    session()->flash('alert-danger', 'Terjadi kesalahan dalam penambahan pengguna');
                }
            }
            else {
                session()->flash('alert-warning', 'Pengguna baru harus memiliki setidaknya 1 peran (Administrator, Anggota PMO, atau Pegawai)');
            }
        }
        return view('pages.admin.adduser');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
//    protected function validator(array $data)
//    {
//        return Validator::make($data, [
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//            'nip' => 'required|string|unique:pegawai',
//        ]);
//    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $new_user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make(User::generatePassword()),
        ]);

        if (isset($data['isAdmin'])) {
            $pegawai = Admin::create([
                'id_user' => $new_user->id,
            ]);
        }

        if (isset($data['isPMO'])) {
            $pmo = PMO::create([
                'id_user' => $new_user->id,
            ]);
        }

        if (isset($data['isPegawai'])) {
            $pegawai = Pegawai::create([
                'id_user' => $new_user->id,
                'nama' => $new_user->name,
                'nip' => $data['nip'],
                'id_pengubah' => $new_user->id,
            ]);
        }

        return $new_user;
    }

    protected function registered(Request $request, $user) {
        $token = app('auth.password.broker')->createToken($user);
        $user->notify(new WelcomeEmail($token));
        return true;
    }
}
