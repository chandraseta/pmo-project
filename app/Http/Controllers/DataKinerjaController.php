<?php

namespace App\Http\Controllers;

use App\Kinerja;
use App\Pegawai;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Exception;

class DataKinerjaController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('kinerja')
            ->join('denormalized_pegawai', 'kinerja.id_pegawai', '=', 'denormalized_pegawai.id_user')
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
        $input = $request->all();

        $validator = $this->validateDataKinerja($input);
        if ($validator->fails()) {
            return $this->sendError('Gagal menambahkan data kinerja.', $validator->errors());
        }

        $nip = $request->input('nip', 'undefined');
        $pegawai = Pegawai::where('nip', '=', $nip)->first();

        if (is_null($pegawai)) {
            return $this->sendError('Pegawai dengan NIP: ' . $nip . ' tidak ditemukan.');
        }

        $data = new Kinerja;
        $data = $this->updateDataKinerja($data, $input);
        $data->pegawai()->associate($pegawai);
        $data->save();

        return $this->sendResponse($data, 'Data kinerja berhasil ditambahkan.');
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
            return $this->sendError('Data Kinerja dengan id = ' . $id . ' tidak ditemukan.');
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

    private function validateDataKinerja($input)
    {
        return Validator::make($input, [
            'tahun' => 'required',
            'semester' => 'required',
            'nilai' => 'required'
        ]);
    }

    private function updateDataKinerja($oldData, $newDataInput)
    {
        $newData = $oldData;

        $newData->tahun = $newDataInput['tahun'];
        $newData->semester = $newDataInput['semester'];
        $newData->nilai = $newDataInput['nilai'];
        $newData->catatan = $newDataInput['catatan'];

        return $newData;
    }

    public function export()
    {
        // Retrieve exported data from database
        $kinerja_rows = DB::table('denormalized_pegawai')
            ->join('kinerja', 'denormalized_pegawai.id_user', '=', 'kinerja.id_pegawai')
            ->select([
                'denormalized_pegawai.nip',
                'denormalized_pegawai.nama',
                'denormalized_pegawai.unit_kerja',
                'denormalized_pegawai.posisi',
                'denormalized_pegawai.pendidikan_terakhir',
                'denormalized_pegawai.tanggal_lahir',
                'kinerja.tahun',
                DB::raw('kinerja.semester + 1'),
                'kinerja.nilai',
                'kinerja.catatan',
            ])->get();

        // Convert StdObj to array
        $kinerja_array = [];
        foreach ($kinerja_rows as $kinerja_row) {
            $kinerja_array[] = get_object_vars($kinerja_row);
        }

        // Add filename
        $timestamp = Carbon::now()->toDateTimeString();
        $filename = 'kinerja_' . $timestamp;

        // Load template
        $storagePath = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $path = $storagePath . 'templates/kinerja_template_export.xlsx';

        // Generate Excel file
        Excel::load($path, function ($excel) use ($kinerja_array, $timestamp) {
            $excel->setTitle('Data Kinerja ' . $timestamp);

            $excel->sheet('sheet1', function ($sheet) use ($kinerja_array) {
                $sheet->fromArray($kinerja_array, null, 'A2', false, false);
            });
        })->setFilename('kinerja_' . $timestamp)->download('xlsx');
    }

    public function import(Request $request)
    {
        if ($request->hasFile('excel')) {
            $extension = File::extension($request->excel->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                $path = $request->excel->getRealPath();
                $objs = Excel::load($path, null)->get();

                if (!empty($objs) && $objs->count()) {
                    try {
                        foreach ($objs as $obj) {
                            $arr = [
                                'id_pegawai' => Pegawai::where('nip', $obj->nip)->first()->id_user,
                                'tahun' => $obj->tahun_pemeriksaan,
                                'semester' => $obj->semester,
                                'nilai' => $obj->skor_kinerja,
                                'catatan' => $obj->catatan,
                            ];
    
                            $model = new Kinerja;
                            $model->fill($arr);
                            $model->save();
                        }
                    } catch (Exception $e) {
                        return response('Failed in inserting data. Check data correctness', 400);
                    }
                    return response('Data inserted', 200);
                } else {
                    return response('Empty file', 400);
                }
            } else {
                return response('Wrong file format', 400);
            }
        } else {
            return response('File not found', 400);
        }
    }
}
