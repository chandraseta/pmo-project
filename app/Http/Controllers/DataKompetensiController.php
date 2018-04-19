<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\PMO;
use Illuminate\Support\Facades\Auth;
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
        if(!$this->authenticate()){return $this->sendError('You are not authenticated.');}

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
        if(!$this->authenticate()){return $this->sendError('You are not authenticated.');}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$this->authenticate()){return $this->sendError('You are not authenticated.');}

        $input = $request->all();

        $validator = $this->validateDataKompetensi($input);
        if ($validator->fails()) {
            return $this->sendError('Gagal menambahkan data kompetensi.', $validator->errors());
        }

        $nip = $input['nip'];
        $pegawai = Pegawai::where('nip', '=', $nip)->first();

        if (is_null($pegawai)) {
            return $this->sendError('Pegawai dengan NIP: '.$nip.' tidak ditemukan.');
        }

        $data = new Kompetensi;
        $data = $this->updateDataKompetensi($data, $input);
        $data->pegawai()->associate($pegawai);
        $data->save();

        return $this->sendResponse($data, 'Data kompetensi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$this->authenticate()){return $this->sendError('You are not authenticated.');}

        $data = Kompetensi::find($id);

        if (is_null($data)) {
            return $this->sendError('Data kompetensi tidak ditemukan.');
        }

        return $this->sendResponse($data, 'Data kompetensi berhasil ditemukan.');
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
        if(!$this->authenticate()){return $this->sendError('You are not authenticated.');}
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
        if(!$this->authenticate()){return $this->sendError('You are not authenticated.');}

        $input = $request->all();

        $validator = $this->validateDataKompetensi($input);
        if($validator->fails()){
            return $this->sendError('Gagal menyimpan data kompetensi.', $validator->errors());
        }

        $data = Kompetensi::find($id);
        if (is_null($data)) {
            $this->sendError('Data Kompetensi dengan id = '.$id.' tidak ditemukan.');
        }

        $data = $this->updateDataKompetensi($data, $input);
        $data->save();

        return $this->sendResponse($data, 'Data kompetensi berhasil disimpan.');
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
        if(!$this->authenticate()){return $this->sendError('You are not authenticated.');}
    }

    private function validateDataKompetensi($input) {
        return Validator::make($input, [
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
    }

    private function updateDataKompetensi($oldData, $newDataInput) {
        $newData = $oldData;

        $newData->tanggal = $newDataInput['tanggal'];
        $newData->kognitif_efisiensi_kecerdasan = $newDataInput['kognitif_efisiensi_kecerdasan'];
        $newData->kognitif_daya_nalar = $newDataInput['kognitif_daya_nalar'];
        $newData->kognitif_daya_asosiasi = $newDataInput['kognitif_daya_asosiasi'];
        $newData->kognitif_daya_analitis = $newDataInput['kognitif_daya_analitis'];
        $newData->kognitif_daya_antisipasi = $newDataInput['kognitif_daya_antisipasi'];
        $newData->kognitif_kemandirian_berpikir = $newDataInput['kognitif_kemandirian_berpikir'];
        $newData->kognitif_fleksibilitas = $newDataInput['kognitif_fleksibilitas'];
        $newData->kognitif_daya_tangkap = $newDataInput['kognitif_daya_tangkap'];
        $newData->interaksional_penempatan_diri = $newDataInput['interaksional_penempatan_diri'];
        $newData->interaksional_percaya_diri = $newDataInput['interaksional_percaya_diri'];
        $newData->interaksional_daya_kooperatif = $newDataInput['interaksional_daya_kooperatif'];
        $newData->interaksional_penyesuaian_perasaan = $newDataInput['interaksional_penyesuaian_perasaan'];
        $newData->emosional_stabilitas_emosi = $newDataInput['emosional_stabilitas_emosi'];
        $newData->emosional_toleransi_stres = $newDataInput['emosional_toleransi_stres'];
        $newData->emosional_pengendalian_diri = $newDataInput['emosional_pengendalian_diri'];
        $newData->emosional_kemantapan_konsentrasi = $newDataInput['emosional_kemantapan_konsentrasi'];
        $newData->sikap_kerja_hasrat_berprestasi = $newDataInput['sikap_kerja_hasrat_berprestasi'];
        $newData->sikap_kerja_daya_tahan = $newDataInput['sikap_kerja_daya_tahan'];
        $newData->sikap_kerja_keteraturan_kerja = $newDataInput['sikap_kerja_keteraturan_kerja'];
        $newData->sikap_kerja_pengerahan_energi_kerja = $newDataInput['sikap_kerja_pengerahan_energi_kerja'];
        $newData->manajerial_efektivitas_perencanaan = $newDataInput['manajerial_efektivitas_perencanaan'];
        $newData->manajerial_pengorganisasian_pelaksanaan = $newDataInput['manajerial_pengorganisasian_pelaksanaan'];
        $newData->manajerial_intensitas_pengarahan = $newDataInput['manajerial_intensitas_pengarahan'];
        $newData->manajerial_kekuatan_pengawasan = $newDataInput['manajerial_kekuatan_pengawasan'];

        return $newData;
    }

    private function authenticate(){
        if (Auth::check()) {
            $session_id = Auth::user()->id;
        }else{
            return false;
        }

        $auth = PMO::find($session_id);

        if (is_null($auth)) {
            return false;
        }

        return true;
    }
}
