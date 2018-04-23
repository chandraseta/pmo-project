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

class ProfileController extends APIBaseController
{
    public function index() {
        if(!$this->authenticate(4)){return redirect('/');}

        $data_kinerja = Kinerja::where('id_pegawai', Auth::user()->id)
                                ->orderBy('tahun', 'ASC')
                                ->orderBy('semester', 'ASC')
                                ->get();
        $unit_kerja = UnitKerja::all();
        $posisi = Posisi::all();
        $kelompok_kompetensi = KelompokKompetensi::all();
        $rekomendasi_training = RekomendasiTraining::where('id_pegawai', Auth::user()->id)->get();
        $training_list = Training::all();
        $rekomendasi_posisi = RekomendasiPosisi::where('id_pegawai', Auth::user()->id)->get();

        return view("profile.index", compact('data_kinerja', 'unit_kerja', 'posisi', 'kelompok_kompetensi', 'rekomendasi_training', 'training_list', 'rekomendasi_posisi'));
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
