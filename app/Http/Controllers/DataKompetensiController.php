<?php

namespace App\Http\Controllers;

use App\Admin;
use App\DenormalizedPegawai;
use App\Http\Controllers\APIBaseController;
use App\Kompetensi;
use App\Pegawai;
use App\PMO;
use App\User;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
        if (!$this->authenticate(4)) {
            return $this->sendError('You are not authenticated.');
        }

        $data = DB::table('kompetensi')
            ->join('denormalized_pegawai', 'kompetensi.id_pegawai', '=', 'denormalized_pegawai.id_user')
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
        if (!$this->authenticate(2)) {
            return $this->sendError('You are not authenticated.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$this->authenticate(2)) {
            return $this->sendError('You are not authenticated.');
        }

        $validator = $this->validateDataKompetensi($request);
        if ($validator->fails()) {
            return $this->sendError('Gagal menambahkan data kompetensi.', 400);
        }

        $nip = $request->input('nip', 'undefined');
        $pegawai = Pegawai::where('nip', '=', $nip)->first();

        if (is_null($pegawai)) {
            return $this->sendError('Pegawai dengan NIP: ' . $nip . ' tidak ditemukan.', 404);
        }

        $data = new Kompetensi;
        $data = $this->updateDataKompetensi($data, $request->all());
        $data = $this->computeDataAverage($data);
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
        if (!$this->authenticate(4)) {
            return $this->sendError('You are not authenticated.');
        }

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
        if (!$this->authenticate(2)) {
            return $this->sendError('You are not authenticated.');
        }
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
        if (!$this->authenticate(2)) {
            return $this->sendError('You are not authenticated.');
        }

        $input = $request->all();

        $validator = $this->validateDataKompetensi($request);
        if ($validator->fails()) {
            return $this->sendError('Gagal menyimpan data kompetensi.', 400);
        }

        $data = Kompetensi::find($id);
        if (is_null($data)) {
            return $this->sendError('Data Kompetensi dengan id = ' . $id . ' tidak ditemukan.', 404);
        }

        $data = $this->updateDataKompetensi($data, $input);
        $data = $this->computeDataAverage($data);
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
        if (!$this->authenticate(2)) {
            return $this->sendError('You are not authenticated.');
        }
    }

    private function validateDataKompetensi(Request $request)
    {
        $input = $request->all();
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

    private function updateDataKompetensi($oldData, $newDataInput)
    {
        $newData = $oldData;

        $newData->tanggal = $newDataInput['tanggal'];
        $newData->tujuan = $newDataInput['tujuan'];
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

    private function computeDataAverage(Kompetensi $input) {
        $data = collect($input->toArray());

        $aspects = collect([
            'kognitif',
            'interaksional',
            'emosional',
            'sikap_kerja',
            'manajerial']);

        $aspectAverages = $aspects->map(function ($item, $key) use ($data, $input) {
            $aspectItems = $data->filter(function ($value, $key) use ($item) {
                return str_contains($key, $item.'_');
            });
            $input[$item] = $aspectItems->avg();
            return $aspectItems->avg();
        });

        $aspectAverages = $aspects->combine($aspectAverages);
        $input->profil_potensi_keberhasilan = (
            2 * $aspectAverages['kognitif'] +
            2 * $aspectAverages['emosional'] +
            1 * $aspectAverages['sikap_kerja'])/5;

        $input->profil_potensi_pengembangan_diri = (
            2 * $aspectAverages['kognitif'] +
            2 * $aspectAverages['sikap_kerja'] +
            1 * $aspectAverages['interaksional'])/5;

        $input->profil_loyalitas_terhadap_tugas = (
            2 * $aspectAverages['emosional'] +
            2 * $aspectAverages['sikap_kerja'] +
            1 * $aspectAverages['kognitif'])/5;

        $input->profil_efektivitas_manajerial = (
            2 * $aspectAverages['emosional'] +
            2 * $aspectAverages['manajerial'] +
            1 * $aspectAverages['kognitif'])/5;

        $data = collect($input->toArray());
        $nilaiPrediksi = $data->filter(function ($value, $key) {
            return str_contains($key, 'profil_');
        })->avg();
        $input->profil = $nilaiPrediksi;
        $input->indeks = $this->getIndeks($nilaiPrediksi);

        return $input;
    }

    private function getIndeks($nilaiPrediksi) {
        if ($nilaiPrediksi >= 5) {
            return 'A';
        } elseif ($nilaiPrediksi >= 3) {
            return 'B';
        } elseif ($nilaiPrediksi >= 2.75) {
            return 'C';
        } elseif ($nilaiPrediksi >= 2.5) {
            return 'D';
        } elseif ($nilaiPrediksi >= 1) {
            return 'E';
        } else {
            return 'ADA YANG SALAH';
        }
    }

    public function export()
    {
        $kompetensi_rows = DB::table('denormalized_pegawai')
            ->join('kompetensi', 'denormalized_pegawai.id_user', '=', 'kompetensi.id_pegawai')
            ->select([
                'denormalized_pegawai.nip',
                'denormalized_pegawai.nama',
                'denormalized_pegawai.unit_kerja',
                'denormalized_pegawai.posisi',
                'denormalized_pegawai.pendidikan_terakhir',
                'denormalized_pegawai.tanggal_lahir',
                'tujuan',
                'tanggal',
                'kognitif_efisiensi_kecerdasan',
                'kognitif_daya_nalar',
                'kognitif_daya_asosiasi',
                'kognitif_daya_analitis',
                'kognitif_daya_antisipasi',
                'kognitif_kemandirian_berpikir',
                'kognitif_fleksibilitas',
                'kognitif_daya_tangkap',
                'kognitif',
                'interaksional_penempatan_diri',
                'interaksional_percaya_diri',
                'interaksional_daya_kooperatif',
                'interaksional_penyesuaian_perasaan',
                'interaksional',
                'emosional_stabilitas_emosi',
                'emosional_toleransi_stres',
                'emosional_pengendalian_diri',
                'emosional_kemantapan_konsentrasi',
                'emosional',
                'sikap_kerja_hasrat_berprestasi',
                'sikap_kerja_daya_tahan',
                'sikap_kerja_keteraturan_kerja',
                'sikap_kerja_pengerahan_energi_kerja',
                'sikap_kerja',
                'manajerial_efektivitas_perencanaan',
                'manajerial_pengorganisasian_pelaksanaan',
                'manajerial_intensitas_pengarahan',
                'manajerial_kekuatan_pengawasan',
                'manajerial',
                'profil_potensi_keberhasilan',
                'profil_potensi_pengembangan_diri',
                'profil_loyalitas_terhadap_tugas',
                'profil_efektivitas_manajerial',
                'profil',
                'indeks',
            ])->get();

        $kompetensi_array = [];

        foreach ($kompetensi_rows as $kompetensi_row) {
            $kompetensi_array[] = get_object_vars($kompetensi_row);
        }

        $timestamp = Carbon::now()->toDateTimeString();
        $filename = 'kompetensi_' . $timestamp;

        $storagePath = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $path = $storagePath . 'templates/kompetensi_template_export.xlsx';

        Excel::load($path, function ($excel) use ($kompetensi_array, $timestamp) {
            $excel->setTitle('Data Kompetensi ' . $timestamp);

            $excel->sheet('sheet1', function ($sheet) use ($kompetensi_array) {
                $sheet->fromArray($kompetensi_array, null, 'A3', false, false);
            });
        })->setFilename('kompetensi_' . $timestamp)->download('xlsx');
    }

    public function import(Request $request)
    {
        if ($request->hasFile('excel')) {
            $extension = File::extension($request->excel->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                // Load data from Excel file
                $path = $request->excel->getRealPath();
                $objs = Excel::load($path, null)->get();

                // Parse data
                if (!empty($objs) && $objs->count()) {
                    try {
                        // Insert each row
                        foreach ($objs as $obj) {
                            $arr = [
                                'id_pegawai' => Pegawai::where('nip', $obj->nip)->first()->id_user,
                                'tujuan' => $obj->tujuan_pemeriksaan,
                                'tanggal' => $obj->tanggal_pelaksanaan,
                                'kognitif_efisiensi_kecerdasan' => $obj->efisiensi_kecerdasan,
                                'kognitif_daya_nalar' => $obj->daya_nalar,
                                'kognitif_daya_asosiasi' => $obj->daya_asosiasi,
                                'kognitif_daya_analitis' => $obj->daya_analitis,
                                'kognitif_daya_antisipasi' => $obj->daya_antisipasi,
                                'kognitif_kemandirian_berpikir' => $obj->kemandirian_berpikir,
                                'kognitif_fleksibilitas' => $obj->fleksibilitas,
                                'kognitif_daya_tangkap' => $obj->daya_tangkap,
                                'interaksional_penempatan_diri' => $obj->penempatan_diri,
                                'interaksional_percaya_diri' => $obj->percaya_diri,
                                'interaksional_daya_kooperatif' => $obj->daya_kooperatif,
                                'interaksional_penyesuaian_perasaan' => $obj->penyesuaian_perasaan,
                                'emosional_stabilitas_emosi' => $obj->stabilitas_emosi,
                                'emosional_toleransi_stres' => $obj->toleransi_terhadap_stress,
                                'emosional_pengendalian_diri' => $obj->pengendalian_diri,
                                'emosional_kemantapan_konsentrasi' => $obj->kemantapan_konsentrasi,
                                'sikap_kerja_hasrat_berprestasi' => $obj->hasrat_berprestasi,
                                'sikap_kerja_daya_tahan' => $obj->daya_tahan,
                                'sikap_kerja_keteraturan_kerja' => $obj->keteraturan_kerja,
                                'sikap_kerja_pengerahan_energi_kerja' => $obj->pengerahan_energi_kerja,
                                'manajerial_efektivitas_perencanaan' => $obj->efektivitas_perencanaan,
                                'manajerial_pengorganisasian_pelaksanaan' => $obj->pengorganisasian_pelaksanaan,
                                'manajerial_intensitas_pengarahan' => $obj->intensitas_pengarahan,
                                'manajerial_kekuatan_pengawasan' => $obj->kekuatan_pengawasan,
                            ];

                            $model = new Kompetensi;
                            $model->fill($arr);
                            $model->save();
                        }
                        return response('Data inserted', 200);
                    } catch (Exception $e) {
                        return response('Failed in inserting data. Check data correctness', 400);
                    }
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

    private function authenticate($role)
    {
        if (Auth::check()) {
            $session_id = Auth::user()->id;
        } else {
            return false;
        }

        $auth = null;
        switch ($role) {
            case 1:
                $auth = Pegawai::find($session_id);
                break;

            case 2:
                $auth = PMO::find($session_id);
                break;

            case 3:
                $auth = Admin::find($session_id);
                break;

            case 4:
                $auth = PMO::find($session_id);
                if (is_null($auth)) {
                    $auth = Pegawai::find($session_id);
                }
                break;
            case 5:
                $auth = User::find($session_id);
                break;
        }

        if (is_null($auth)) {
            return false;
        }

        return true;
    }
}
