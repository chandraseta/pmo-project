<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\APIBaseController as APIBaseController;
use App\Sertifikat;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
// use Intervention\Image\Facades\Image;

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
        	$imageData = $input['sertifikat'][$i]['nama_file'];

            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];

            // ini_set('memory_limit','256M');
            
            $image = Image::make($input['sertifikat'][$i]['nama_file']);	
            $image->save(public_path('sertifikat/').$fileName);

            $postSertifikat = Sertifikat::create([
                'id_pegawai' => $id,
                'nama_file' => $fileName,
                'judul' => $input['sertifikat'][$i]['judul'],
                'lembaga' => $input['sertifikat'][$i]['lembaga'],
                'tahun_diterbitkan' => $input['sertifikat'][$i]['tahun_diterbitkan'],
                'catatan' => $input['sertifikat'][$i]['catatan'],
            ]);
        }

        return $this->sendResponse($input, 'Sertifikat created successfully.');
    }
}
