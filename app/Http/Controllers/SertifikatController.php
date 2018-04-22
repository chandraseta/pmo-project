<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\APIBaseController as APIBaseController;
use App\Sertifikat;

class SertifikatController extends APIBaseController
{

	public function index(){
		$sertifikat = Sertifikat::all();
		return $this->sendResponse($sertifikat, 'Sertifikat created successfully.');
	}

    public function update(Request $request, $id){
    	// if (!$this->authenticate(4)) {return $this->sendError('You are not authenticated.');}

    	$input = $request->all();

        $sertifikat = Sertifikat::where('id_pegawai', $id);

        if ($sertifikat->count() > 0) {
            $sertifikat->delete();
        }

        for ($i = 0; $i < count($input['sertifikat']); $i++) {
            // $photoTimeAsName = time() . '.' . $input['sertifikat'][$i]->getClientOriginalExtension();
            // $input['sertifikat_user_photo_' . $i]->move(public_path('sertifikat'), $photoTimeAsName);

            $postSertifikat = Sertifikat::create([
                'id_pegawai' => $id,
                'nama_file' => $input['sertifikat'][$i]['nama_file'],
                'judul' => $input['sertifikat'][$i]['judul'],
                'lembaga' => $input['sertifikat'][$i]['lembaga'],
                'tahun_diterbitkan' => $input['sertifikat'][$i]['tahun_diterbitkan'],
                'catatan' => $input['sertifikat'][$i]['catatan'],
            ]);
        }

        return $this->sendResponse($input, 'Sertifikat created successfully.');
    }
}
