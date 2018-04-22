<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\APIBaseController as APIBaseController;
use App\Sertifikat;

class SertifikatController extends APIBaseController
{
    public function update(Request $request, $id){
    	// if (!$this->authenticate(4)) {return $this->sendError('You are not authenticated.');}

    	$input = $request->all();

        return $this->sendResponse($input, 'Sertifikat Retrieved.');
        
        $sertifikat = Sertifikat::where('id_pegawai', $id);

        if ($sertifikat->count() > 0) {
            $sertifikat->delete();
        }

        for ($i = 1; $i <= $input['sertifikat_counter']; $i++) {
            $photoTimeAsName = time() . '.' . $input['sertifikat_user_photo_' . $i]->getClientOriginalExtension();
            $input['sertifikat_user_photo_' . $i]->move(public_path('sertifikat'), $photoTimeAsName);

            $postSertifikat = Sertifikat::create([
                'id_pegawai' => $id,
                'nama_file' => $photoTimeAsName,
                'judul' => $input['sertifikat_judul_' . $i],
                'lembaga' => $input['sertifikat_lembaga_' . $i],
                'tahun_diterbitkan' => $input['sertifikat_tahun_diterbitkan_' . $i],
                'catatan' => $input['sertifikat_catatan_' . $i],
            ]);
        }

        return $this->sendResponse([], 'Sertifikat created successfully.');
    }
}
