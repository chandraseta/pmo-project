<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\APIBaseController;
use App\Kompetensi;
use Validator;

class DataKompetensiController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kompetensi::all();
        return $this->sendResponse($data->toArray(), 'Data Kompetensi retrieved successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Kompetensi::find($id);

        if (is_null($data)) {
            return $this->sendError('Data Kompetensi is not found.');
        }

        return $this->sendResponse($data, 'Data Kompetensi retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
           'id_pegawai' => 'required',
           'tanggal' => 'required',
           'kognitif_efisiensi_kecerdasan' => 'required',
           'kognitif_daya_nalar' => 'required',
           'kognitif_daya_asosiasi' => 'required',
           'kognitif_daya_analitis' => 'required',
           'kognitif_daya_antisipasi' => 'required',
           'kognitif_kemandirian_berpikir' => 'required',
           'kognitif_fleksibilitas' => 'required',
           'kognitif_daya_tangkap' => 'required',
           'interaksional_penempatan_diri' => 'required',
           'interaksional_percaya_diri' => 'required',
           'interaksional_daya_kooperatif' => 'required',
           'interaksional_penyesuaian_perasaan' => 'required',
           'emosional_stabilitas_emosi' => 'required',
           'emosional_toleransi_stres' => 'required',
           'emosional_pengendalian_diri' => 'required',
           'emosional_kemantapan_konsentrasi' => 'required',
           'sikap_kerja_hasrat_berprestasi' => 'required',
           'sikap_kerja_daya_tahan' => 'required',
           'sikap_kerja_keteraturan_kerja' => 'required',
           'sikap_kerja_pengerahan_energi_kerja' => 'required',
           'manajerial_efektivitas_perencanaan' => 'required',
           'manajerial_pengorganisasian_pelaksanaan' => 'required',
           'manajerial_intensitas_pengarahan' => 'required',
            'manajerial_kekuatan_pengawasan' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $data = Kompetensi::find($id);

        if (is_null($data)) {
            $this->sendError('Data Kompetensi with id = '.$id.' is not found');
        }

        return $this->sendResponse($data, 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
