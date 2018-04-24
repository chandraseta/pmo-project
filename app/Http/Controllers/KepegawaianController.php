<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\APIBaseController as APIBaseController;
use App\DataKepegawaian;
use App\Pegawai;

class KepegawaianController extends APIBaseController
{
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $list = array();

        for ($i = 0; $i < count($input['kepegawaian']); $i++) {

            $kepegawaian = DataKepegawaian::find($input['kepegawaian'][$i]['id_data_kepegawaian']);

            if(is_null($kepegawaian)){
            	$postDataKepegawaian = DataKepegawaian::create([
	                'id_pegawai' => $id,
	                'id_posisi' => $input['kepegawaian'][$i]['id_posisi'],
	                'id_unit_kerja' => $input['kepegawaian'][$i]['id_unit_kerja'],
	                'tahun_masuk' => $input['kepegawaian'][$i]['tahun_masuk'],
	                'tahun_keluar' => $input['kepegawaian'][$i]['tahun_keluar'],
            	]);
        		array_push($list, $postDataKepegawaian->id_data_kepegawaian);
            }else{
	            $kepegawaian->id_pegawai = $input['kepegawaian'][$i]['id_pegawai'];
	            $kepegawaian->id_posisi = $input['kepegawaian'][$i]['id_posisi'];
	            $kepegawaian->id_unit_kerja = $input['kepegawaian'][$i]['id_unit_kerja'];
	            $kepegawaian->tahun_masuk = $input['kepegawaian'][$i]['tahun_masuk'];
	            $kepegawaian->tahun_keluar = $input['kepegawaian'][$i]['tahun_keluar'];

	            $kepegawaian->save();
	            array_push($list, $input['kepegawaian'][$i]['id_data_kepegawaian']);
            }
            
        }

        $data = DataKepegawaian::where('id_pegawai',$id)->whereNotIn('id_data_kepegawaian', $list);
        $data->delete();

        return $this->sendResponse($input, 'Kepegawaian updated successfully.');

    }
}
