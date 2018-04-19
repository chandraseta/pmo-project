<?php

namespace App\Http\Controllers\Pegawai;

use App\Admin;
use App\DataKepegawaian;
use App\DenormalizedPegawai;
use App\Http\Controllers\APIBaseController as APIBaseController;
use App\Pegawai;
use App\PMO;
use App\RiwayatPekerjaan;
use App\RiwayatPendidikan;
use App\Sertifikat;
use App\User;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;


class PegawaiAPIController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!$this->authenticate(5)) {
            return $this->sendError('You are not authenticated.');
        }

        $user = Pegawai::with(['user', 'riwayatPendidikans', 'riwayatPekerjaans', 'dataKepegawaians'])->get();

        return $this->sendResponse($user, 'Profiles retrieved successfully.');
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


        $input = $request->all();

        $validator = Validator::make($input, [
            'email' => 'required',
            'password' => 'required',
            'nama' => 'required',
            'nip' => 'required',
            'id_pengubah' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $find = User::where('email', $input['email'])->count();

        if ($find != 0) {
            return $this->sendError('Email Already Exist');
        }

        $postUser = User::create([
            'name' => $input['nama'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $user = User::where('email', $input['email'])->first();

        $postPegawai = Pegawai::create([
            'id_user' => $user->id,
            'nama' => $input['nama'],
            'nip' => $input['nip'],
            'id_pengubah' => $user->id,
        ]);

        $post = array_merge($postUser->toArray(), $postPegawai->toArray());

        return $this->sendResponse($post, 'User created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$this->authenticate(5)) {
            return $this->sendError('You are not authenticated.');
        }

        $pegawai = Pegawai::find($id);

        if (is_null($pegawai)) {
            return $this->sendError('Profile not found.');
        }

        $user = User::find($id);

        $pendidikan = RiwayatPendidikan::where("id_pegawai", $id);
        $pekerjaan = RiwayatPekerjaan::where("id_pegawai", $id);
        $kepegawaian = DataKepegawaian::where("id_pegawai", $id);

        $data = [
            'user' => $user->toArray(),
            'pegawai' => $pegawai->toArray(),
            'pendidikan' => $pendidikan->get()->toArray(),
            'pekerjaan' => $pekerjaan->get()->toArray(),
            'kepegawaian' => $kepegawaian->get()->toArray(),
        ];

        return $this->sendResponse($data, 'Profile retrieved successfully.');
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

        if (!$this->authenticate(4)) {
            return $this->sendError('You are not authenticated.');
        }


        $input = $request->all();

        $validator = Validator::make($input, [
            'email' => 'required',
            'password' => 'required',
            'nama' => 'required',
            'nip' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $pegawai = Pegawai::where('id_user', $id)->first();

        if (is_null($pegawai)) {
            return $this->sendError('Profile not found.');
        }

        $find = User::where('email', $input['email']);
        $user = User::find($id);


        if ($find->count() != 0 && $find->first()->email != $user->email) {
            return $this->sendError('Email Already Exist');
        }

        $user->name = $input['nama'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $pegawai->nama = $input['nama'];
        $pegawai->nip = $input['nip'];
        $pegawai->tempat_lahir = $input['tempat_lahir'];
        $pegawai->tanggal_lahir = $input['tanggal_lahir'];

        $pendidikan = RiwayatPendidikan::where('id_pegawai', $id);

        if ($pendidikan->count() > 0) {
            $pendidikan->delete();
        }

        for ($i = 1; $i <= $input['pendidikan_counter']; $i++) {
            $postRiwayatPendidikan = RiwayatPendidikan::create([
                'id_pegawai' => $id,
                'nama_institusi' => $input['pendidikan_nama_institusi_' . $i],
                'strata' => $input['pendidikan_strata_' . $i],
                'jurusan' => $input['pendidikan_jurusan_' . $i],
                'tahun_masuk' => $input['pendidikan_tahun_masuk_' . $i],
                'tahun_keluar' => $input['pendidikan_tahun_keluar_' . $i],
            ]);
        }

        $pekerjaan = RiwayatPekerjaan::where('id_pegawai', $id);

        if ($pekerjaan->count() > 0) {
            $pekerjaan->delete();
        }

        for ($i = 1; $i <= $input['pekerjaan_counter']; $i++) {
            $postRiwayatPekerjaan = RiwayatPekerjaan::create([
                'id_pegawai' => $id,
                'nama_institusi' => $input['pekerjaan_nama_institusi_' . $i],
                'posisi' => $input['pekerjaan_posisi_' . $i],
                'tahun_masuk' => $input['pekerjaan_tahun_masuk_' . $i],
                'tahun_keluar' => $input['pekerjaan_tahun_keluar_' . $i],
            ]);
        }

        $kepegawaian = DataKepegawaian::where('id_pegawai', $id);

        if ($kepegawaian->count() > 0) {
            $kepegawaian->delete();
        }

        for ($i = 1; $i <= $input['kepegawaian_counter']; $i++) {
            $postDataKepegawaian = DataKepegawaian::create([
                'id_pegawai' => $id,
                'kompetensi' => $input['kepegawaian_kompetensi_' . $i],
                'unit_kerja' => $input['kepegawaian_unit_kerja_' . $i],
                'posisi' => $input['kepegawaian_posisi_' . $i],
                'tahun_masuk' => $input['kepegawaian_tahun_masuk_' . $i],
                'tahun_keluar' => $input['kepegawaian_tahun_keluar_' . $i],
            ]);
        }

        $sertifikat = Sertifikat::where('id_pegawai', $id);

        if ($sertifikat->count() > 0) {
            $sertifikat->delete();
        }

        for ($i = 1; $i <= $input['sertifikat_counter']; $i++) {
            $photoTimeAsName = time() . '.' . $input['sertifikat_user_photo_' . $i]->getClientOriginalExtension();
            $input['sertifikat_user_photo_' . $i]->move(public_path('avatars'), $photoTimeAsName);

            $postSertifikat = Sertifikat::create([
                'id_pegawai' => $id,
                'nama_file' => $photoTimeAsName,
                'judul' => $input['sertifikat_judul_' . $i],
                'lembaga' => $input['sertifikat_lembaga_' . $i],
                'tahun_diterbitkan' => $input['sertifikat_tahun_diterbitkan_' . $i],
                'catatan' => $input['sertifikat_catatan_' . $i],
            ]);
        }

        $user->save();
        $pegawai->save();

        $data = array_merge(
            $user->toArray(),
            $pegawai->toArray(),
            $pendidikan->get()->toArray(),
            $pekerjaan->get()->toArray(),
            $kepegawaian->get()->toArray(),
            $sertifikat->get()->toArray()
        );

        return $this->sendResponse($data, 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (!$this->authenticate(3)) {
            return $this->sendError('You are not authenticated.');
        }

        $user = User::find($id);

        if (is_null($user)) {
            return $this->sendError('Profile not found.');
        }

        $pendidikan = RiwayatPendidikan::where('id_pegawai', $id);

        if ($pendidikan->count() > 0) {
            $pendidikan->delete();
        }

        $pekerjaan = RiwayatPekerjaan::where('id_pegawai', $id);

        if ($pekerjaan->count() > 0) {
            $pekerjaan->delete();
        }

        $kepegawaian = DataKepegawaian::where('id_pegawai', $id);

        if ($kepegawaian->count() > 0) {
            $kepegawaian->delete();
        }

        $pegawai = Pegawai::where('id_user', $id);
        $pegawai->delete();

        $user->delete();

        return $this->sendResponse($id, 'Tag deleted successfully.');
    }

    public function export()
    {
        $pegawai_rows = DB::table('denormalized_pegawai')->select([
            'denormalized_pegawai.nip',
            'denormalized_pegawai.nama',
            'denormalized_pegawai.unit_kerja',
            'denormalized_pegawai.posisi',
            'denormalized_pegawai.tahun_masuk_kerja',
            'denormalized_pegawai.pendidikan_terakhir',
            'denormalized_pegawai.no_telp',
            'denormalized_pegawai.tanggal_lahir'
        ])->get();

        $pegawai_array = [];

        // Row headers
        $pegawai_array[] = [
            'NIP',
            'Nama Lengkap',
            'Unit Kerja',
            'Jabatan',
            'Tahun Menjabat',
            'Pendidikan',
            'No. Telp.',
            'Tanggal Lahir'
        ];

        foreach ($pegawai_rows as $pegawai_row) {
            $pegawai_array[] = get_object_vars($pegawai_row);
        }

        $timestamp = Carbon::now()->toDateTimeString();
        $filename = 'pegawai_' . $timestamp;
        Excel::create($filename, function ($excel) use ($pegawai_array, $timestamp) {
            $excel->setTitle('Data Pegawai ' . $timestamp)
                ->setCreator('UPT PMO ITB')
                ->setCompany('UPT PMO ITB')
                ->setDescription('Data pegawai UPT PMO ITB pada ' . $timestamp);

            $excel->sheet('sheet1', function ($sheet) use ($pegawai_array) {
                $sheet->fromArray($pegawai_array, null, 'A1', false, false);

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