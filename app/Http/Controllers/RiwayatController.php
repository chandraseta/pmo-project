<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function update(Request $request){
    	$pendidikan = RiwayatPendidikan::where('id_pegawai', $id);

        if ($pendidikan->count() > 0) {
            $pendidikan->delete();
        }

        for ($i = 1; $i <= $input['pendidikan_counter']; $i++) {
            $postRiwayatPendidikan = RiwayatPendidikan::create([
                'id_pegawai' => $id,
                'nama_institusi' => $input['pendidikan_nama_institusi_' . $i],
                'strata' => $input['pendidikan_strata_' . $i],
                'jurusan' => $input['pendidikan_jurusan_' . $i],
                'tahun_masuk' => $input['pendidikan_tahun_masuk_' . $i],
                'tahun_keluar' => $input['pendidikan_tahun_keluar_' . $i],
            ]);
        }

        $pekerjaan = RiwayatPekerjaan::where('id_pegawai', $id);

        if ($pekerjaan->count() > 0) {
            $pekerjaan->delete();
        }

        for ($i = 1; $i <= $input['pekerjaan_counter']; $i++) {
            $postRiwayatPekerjaan = RiwayatPekerjaan::create([
                'id_pegawai' => $id,
                'nama_institusi' => $input['pekerjaan_nama_institusi_' . $i],
                'posisi' => $input['pekerjaan_posisi_' . $i],
                'tahun_masuk' => $input['pekerjaan_tahun_masuk_' . $i],
                'tahun_keluar' => $input['pekerjaan_tahun_keluar_' . $i],
            ]);
        }
    }
}
