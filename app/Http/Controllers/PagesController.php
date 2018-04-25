<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\APIBaseController as APIBaseController;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Pegawai;
use App\PMO;
use App\Admin;
use App\Kinerja;
use App\UnitKerja;
use App\Posisi;
use App\KelompokKompetensi;
use App\RekomendasiPosisi;
use App\RekomendasiTraining;
use App\Training;

class PagesController extends APIBaseController
{
    public function index() {
        if(!$this->authenticate(6)){return redirect('/');}
        return view('welcome');
    }

    public function landing() {
        if(!$this->authenticate(6)){return redirect('/');}
        if(!$this->authenticate(3) and !$this->authenticate(2) and $this->authenticate(1)){return redirect('/pages/profile');}
        return view('pages');
    }

    public function pegawai(){
        if(!$this->authenticate(4)){return redirect('/');}

        $id = Auth::user()->id;

        $data_kinerja = Kinerja::where('id_pegawai', $id)
                                ->orderBy('tahun', 'ASC')
                                ->orderBy('semester', 'ASC')
                                ->get();
        $unit_kerja = UnitKerja::all();
        $posisi = Posisi::all();
        $kelompok_kompetensi = KelompokKompetensi::all();
        $rekomendasi_training = RekomendasiTraining::where('id_pegawai', $id)->get();
        $training_list = Training::all();
        $rekomendasi_posisi = RekomendasiPosisi::where('id_pegawai', $id)->get();
        $id_pengubah = Pegawai::where('id_user', $id)->first()->id_pengubah;
        if ($id_pengubah === $id) {
            $nama_pengubah = "Anda";
        } else {
            $nama_pengubah = User::where('id', $id_pengubah)->first()->name;
        }
        $last_edited = Pegawai::where('id_user', $id)->first()->updated_at;

        return view("profile.index", compact('last_edited', 'nama_pengubah','data_kinerja', 'unit_kerja', 'posisi', 'kelompok_kompetensi', 'rekomendasi_training', 'training_list', 'rekomendasi_posisi'));
    }

    public function pmo() {
        if(!$this->authenticate(2)){return redirect('/');}
        return view('pages.pmo')->with('page', 'pmo');
    }

    public function admin() {
        if(!$this->authenticate(3)){return redirect('/');}
        return view('pages.admin')->with('page', 'admin');
    }

    public function addUser() {
        if(!$this->authenticate(3)){return redirect('/');}
        return view('pages.admin.adduser')->with('page', 'addUser');
    }

    private function authenticate($role){
        if (Auth::check()) {
            $session_id = Auth::user()->id;
        }else{
            return false;
        }

        $auth = NULL;
        switch ($role) {
            case 1:
                $auth = Pegawai::find($session_id);
                break;
            
            case 2:
                $auth = PMO::find($session_id);
                break;

            case 3:
                $auth = Admin::find($session_id);
                break;

            case 4:
                $auth = PMO::find($session_id);
                if (is_null($auth)) {
                    $auth = Pegawai::find($session_id);
                }
                break;

            case 5:
                $auth = PMO::find($session_id);
                if (is_null($auth)) {
                    $auth = Admin::find($session_id);
                }
                break;

            case 6:
                $auth = User::find($session_id);
                break;
        }

        if (is_null($auth)) {
            return false;
        }

        return true;
    }
}
