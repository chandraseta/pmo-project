<?php

namespace App\Http\Controllers;

use App\Http\Controllers\APIBaseController as APIBaseController;
use Illuminate\Http\Request;
use App\Pegawai;

class LastEditedController extends APIBaseController
{
    public function update(Request $request, $id){

        $input = $request->all();

        $pegawai = Pegawai::where('id_user', $id)->first();
        // $pegawai->id_pengubah = $input['id_pengubah'];
        $pegawai->updated_at = now();
        $pegawai->save();

        return $this->sendResponse($input, 'Rekomedasi updated successfully.');
    }
}
