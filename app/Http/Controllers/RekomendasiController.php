<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\APIBaseController as APIBaseController;
use App\RekomendasiPosisi;
use App\RekomendasiTraining;


class RekomendasiController extends APIBaseController
{
    public function update(Request $request, $id){

        $input = $request->all();

        $listRekomendasiTraining = array();

        for ($i = 0; $i < count($input['training']); $i++) {

            $training = RekomendasiTraining::find($input['training'][$i]['id_rekomendasi_training']);

            if(is_null($training)){
                $postRekomendasiTraining = RekomendasiTraining::create([
                    'id_pegawai' => $id,
                    'id_training' => $input['training'][$i]['id_training'],
                ]);
                array_push($listRekomendasiTraining, $postRekomendasiTraining->id_rekomendasi_training);
            }else{
                $training->id_training = $input['training'][$i]['id_training'];

                $training->save();
                array_push($listRekomendasiTraining, $input['training'][$i]['id_rekomendasi_training']);
            }

        }

        $data = RekomendasiTraining::where('id_pegawai',$id)->whereNotIn('id_rekomendasi_training', $listRekomendasiTraining);
        $data->delete();

        $listRekomendasiPosisi = array();

        for ($i = 0; $i < count($input['posisi']); $i++) {

            $posisi = RekomendasiPosisi::find($input['posisi'][$i]['id_rekomendasi_posisi']);

            if(is_null($posisi)){
                $postRekomendasiPosisi = RekomendasiPosisi::create([
                    'id_pegawai' => $id,
                    'id_unit_kerja' => $input['posisi'][$i]['id_unit_kerja'],
                    'id_posisi' => $input['posisi'][$i]['id_posisi']
                ]);
                array_push($listRekomendasiPosisi, $postRekomendasiPosisi->id_rekomendasi_posisi);
            }else{   
                $posisi->id_unit_kerja = $input['posisi'][$i]['id_unit_kerja'];
                $posisi->id_posisi = $input['posisi'][$i]['id_posisi'];

                $posisi->save();
                array_push($listRekomendasiPosisi, $input['posisi'][$i]['id_rekomendasi_posisi']);
            }
            
        }

        $data = RekomendasiPosisi::where('id_pegawai',$id)->whereNotIn('id_rekomendasi_posisi', $listRekomendasiPosisi);
        $data->delete();

        return $this->sendResponse($input, 'Rekomedasi updated successfully.');
    }
}
