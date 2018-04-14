<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\APIBaseController;
use App\Kompetensi;
use Validator;
use DB;

class DataKompetensiController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data = Kompetensi::all();
        $data = DB::table('kompetensi')
            ->join('pegawai', 'kompetensi.id_pegawai', '=', 'pegawai.id_user')
            ->get();

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

        $data->id_pegawai = $input['id_pegawai'];
        $data->tanggal = $input['tanggal'];
        $data->kognitif_efisiensi_kecerdasan = $input['kognitif_efisiensi_kecerdasan'];
        $data->kognitif_daya_nalar = $input['kognitif_daya_nalar'];
        $data->kognitif_daya_asosiasi = $input['kognitif_daya_asosiasi'];
        $data->kognitif_daya_analitis = $input['kognitif_daya_analitis'];
        $data->kognitif_daya_antisipasi = $input['kognitif_daya_antisipasi'];
        $data->kognitif_kemandirian_berpikir = $input['kognitif_kemandirian_berpikir'];
        $data->kognitif_fleksibilitas = $input['kognitif_fleksibilitas'];
        $data->kognitif_daya_tangkap = $input['kognitif_daya_tangkap'];
        $data->interaksional_penempatan_diri = $input['interaksional_penempatan_diri'];
        $data->interaksional_percaya_diri = $input['interaksional_percaya_diri'];
        $data->interaksional_daya_kooperatif = $input['interaksional_daya_kooperatif'];
        $data->interaksional_penyesuaian_perasaan = $input['interaksional_penyesuaian_perasaan'];
        $data->emosional_stabilitas_emosi = $input['emosional_stabilitas_emosi'];
        $data->emosional_toleransi_stres = $input['emosional_toleransi_stres'];
        $data->emosional_pengendalian_diri = $input['emosional_pengendalian_diri'];
        $data->emosional_kemantapan_konsentrasi = $input['emosional_kemantapan_konsentrasi'];
        $data->sikap_kerja_hasrat_berprestasi = $input['sikap_kerja_hasrat_berprestasi'];
        $data->sikap_kerja_daya_tahan = $input['sikap_kerja_daya_tahan'];
        $data->sikap_kerja_keteraturan_kerja = $input['sikap_kerja_keteraturan_kerja'];
        $data->sikap_kerja_pengerahan_energi_kerja = $input['sikap_kerja_pengerahan_energi_kerja'];
        $data->manajerial_efektivitas_perencanaan = $input['manajerial_efektivitas_perencanaan'];
        $data->manajerial_pengorganisasian_pelaksanaan = $input['manajerial_pengorganisasian_pelaksanaan'];
        $data->manajerial_intensitas_pengarahan = $input['manajerial_intensitas_pengarahan'];
        $data->manajerial_kekuatan_pengawasan = $input['manajerial_kekuatan_pengawasan'];

        $data->save();

        return $this->sendResponse($data, 'Data Kompetensi successfully updated.');
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
