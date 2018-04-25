<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\APIBaseController as APIBaseController;
use App\Sertifikat;
use App\Pegawai;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class SertifikatController extends APIBaseController
{

    public function index(){
        $sertifikat = Sertifikat::all();
        return $this->sendResponse($sertifikat, 'Sertifikat created successfully.');
    }

    public function update(Request $request, $id){
        // if (!$this->authenticate(4)) {return $this->sendError('You are not authenticated.');}

        $input = $request->all();

        $pegawai = Pegawai::find($id);
        $list = array();

        for ($i = 0; $i < count($input['sertifikat']); $i++) {

            $imageData = $input['sertifikat'][$i]['nama_file'];

            if(explode("/", $imageData)[0] === "data:image"){
                $fileName =  $pegawai->nip . '_' . $i . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                $image = Image::make($imageData);   
                $image->save(public_path('sertifikat/').$fileName);
            }else{
                $string = explode("/", $imageData);
                $fileName = $string[count($string)-1];
            }

            $sertifikat = null;
            if(!is_null($input['sertifikat'][$i]['id_sertifikat'])){
                $sertifikat = Sertifikat::find($input['sertifikat'][$i]['id_sertifikat']);
            }

            if(is_null($sertifikat)){
                $id = (int) $id;
                $postSertifikat = Sertifikat::create([
                    'id_pegawai' => $id,
                    'nama_file' => $fileName,
                    'judul' => $input['sertifikat'][$i]['judul'],
                    'lembaga' => $input['sertifikat'][$i]['lembaga'],
                    'tahun_diterbitkan' => $input['sertifikat'][$i]['tahun_diterbitkan'],
                    'catatan' => $input['sertifikat'][$i]['catatan'],
                ]);
                array_push($list, $postSertifikat->id_sertifikat);
            }else{
                $sertifikat->id_pegawai = $id;
                $sertifikat->nama_file = $fileName;
                $sertifikat->judul = $input['sertifikat'][$i]['judul'];
                $sertifikat->lembaga = $input['sertifikat'][$i]['lembaga'];
                $sertifikat->tahun_diterbitkan = $input['sertifikat'][$i]['tahun_diterbitkan'];
                $sertifikat->catatan = $input['sertifikat'][$i]['catatan'];

                $sertifikat->save();
                array_push($list, $sertifikat->id_sertifikat);
            }
        }

        $data = Sertifikat::where('id_pegawai',$id)->whereNotIn('id_sertifikat', $list);
        $data->delete();

        return $this->sendResponse($id, 'Sertifikat updated successfully.');
    }
}
