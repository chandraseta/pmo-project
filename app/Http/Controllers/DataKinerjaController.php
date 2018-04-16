<?php

namespace App\Http\Controllers;

use App\Kinerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DataKinerjaController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $data = Kinerja::all();
        $data = DB::table('kinerja')
            ->join('pegawai', 'kinerja.id_pegawai', '=', 'pegawai.id_user')
            ->get();
        return $this->sendResponse($data, 'Data Kinerja retrieved successfully.');
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
        $data = Kinerja::find($id);

        if (is_null($data)) {
            return $this->sendError('Data Kinerja tidak ditemukan.');
        }

        return $this->sendResponse($data, 'Data Kinerja berhasil ditemukan');
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

        $validator = $this->validateDataKinerja($input);
        if ($validator->fails()) {
            return $this->sendError('Gagal menyimpan data kinerja.', $validator->errors());
        }

        $data = Kinerja::find($id);
        if (is_null($data)) {
            $this->sendError('Data Kinerja dengan id = '.$id.' tidak ditemukan.');
        }

        $data = $this->updateDataKinerja($data, $input);
        $data->save();

        return $this->sendResponse($data, 'Data kinerja berhasil disimpan.');
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

    private function validateDataKinerja($input) {
        return Validator::make($input, [
            'tahun' => 'required',
            'semester' => 'required',
            'nilai' => 'required'
        ]);
    }

    private function updateDataKinerja($oldData, $newDataInput) {
        $newData = $oldData;

        $newData->tahun = $newDataInput['tahun'];
        $newData->semester = $newDataInput['semester'];
        $newData->nilai = $newDataInput['nilai'];

        return $newData;
    }
}
