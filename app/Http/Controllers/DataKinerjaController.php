<?php

namespace App\Http\Controllers;

use App\Kinerja;
use App\Pegawai;
use Carbon\Carbon;
use Excel;
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

        $kinerja_array = [];

        // Row headers
        $kinerja_array[] = [
            "NIP",
            "Nama Lengkap",
            "Unit Kerja",
            "Jabatan",
            "Pendidikan",
            "Tanggal Lahir",
            "Tahun Pemeriksaan",
            "Semester",
            "Skor Kinerja",
            "Catatan"
        ];

        foreach ($kinerja_rows as $kinerja_row) {
            $kinerja_array[] = get_object_vars($kinerja_row);
        }

        $timestamp = Carbon::now()->toDateTimeString();
        $filename = 'kinerja_' . $timestamp;
        Excel::create($filename, function ($excel) use ($kinerja_array, $timestamp) {
            $excel->setTitle('Data Kinerja ' . $timestamp)
                ->setCreator('UPT PMO ITB')
                ->setCompany('UPT PMO ITB')
                ->setDescription('Data kinerja pegawai UPT PMO ITB pada ' . $timestamp);

            $excel->sheet('sheet1', function ($sheet) use ($kinerja_array) {
                $sheet->fromArray($kinerja_array, null, 'A1', false, false);

                $sheet->row(1, function ($row) {
                    $row->setFontWeight('bold')
                        ->setBorder(array(
                            'bottom' => array(
                                'style' => 'solid'
                            )
                        ));
                });
                $sheet->freezeFirstRow();
            });
        })->download('xlsx');
    }
}
