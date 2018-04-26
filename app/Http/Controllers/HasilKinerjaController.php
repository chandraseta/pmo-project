<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\APIBaseController as APIBaseController;
use App\Kinerja;
// use App\Pegawai;


class HasilKinerjaController extends APIBaseController
{
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $list = array();

        for ($i = 0; $i < count($input['kinerja']); $i++) {

            $kinerja = Kinerja::find($input['kinerja'][$i]['id_kinerja']);

            if(is_null($kinerja)){
            	$postKinerja = Kinerja::create([
	                'id_pegawai' => $id,
	                'tahun' => $input['kinerja'][$i]['tahun'],
	                'semester' => $input['kinerja'][$i]['semester'],
	                'nilai' => $input['kinerja'][$i]['nilai'],
	                'catatan' => $input['kinerja'][$i]['catatan'],
            	]);
        		array_push($list, $postKinerja->id_kinerja);
            }else{
	            // $kinerja->id_pegawai = $input['kinerja'][$i]['id_pegawai'];
	            $kinerja->tahun = $input['kinerja'][$i]['tahun'];
	            $kinerja->semester = $input['kinerja'][$i]['semester'];
	            $kinerja->nilai = $input['kinerja'][$i]['nilai'];
	            $kinerja->catatan = $input['kinerja'][$i]['catatan'];

	            $kinerja->save();
	            array_push($list, $input['kinerja'][$i]['id_kinerja']);
            }
            
        }

        $data = Kinerja::where('id_pegawai',$id)->whereNotIn('id_kinerja', $list);
        $data->delete();

        return $this->sendResponse($input, 'Kinerja updated successfully. sip');

    }
}
