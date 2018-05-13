<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\APIBaseController as APIBaseController;
use App\User;
use App\Pegawai;
use App\PMO;
use App\Admin;
use App\DataKepegawaian;
use App\RiwayatPekerjaan;
use App\RiwayatPendidikan;
use App\Sertifikat;
use App\DenormalizedPegawai;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Validator;
use ImageOptimizer as ImageOptimizer;


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
        if(!$this->authenticate(6)){return $this->sendError('You are not authenticated.');}

        $pegawai = Pegawai::find($id);

        if (is_null($pegawai)) {
            return $this->sendError('Profile not found.');
        }

        $user = User::find($id);

        $pendidikan = RiwayatPendidikan::where("id_pegawai", $id);
        $pekerjaan = RiwayatPekerjaan::where("id_pegawai", $id);
        $kepegawaian = DataKepegawaian::where("id_pegawai", $id);
        $sertifikat = Sertifikat::where("id_pegawai", $id);

        $data = [
            'user' => $user->toArray(),
            'pegawai' => $pegawai->toArray(),
            'pendidikan' => $pendidikan->get()->toArray(),
            'pekerjaan' => $pekerjaan->get()->toArray(),
            'kepegawaian' => $kepegawaian->get()->toArray(),
            'sertifikat' => $sertifikat->get()->toArray(),
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

        // if (!$this->authenticate(4)) {return $this->sendError('You are not authenticated.');}

        $input = $request->all();

        // return $this->sendResponse($input, 'Profile updated successfully.');

        // $validator = Validator::make($input['pegawai'], [
        //     'nama' => 'required',
        //     'tempat_lahir' => 'required',
        //     'tanggal_lahir' => 'required',
        //     'email' => 'required',
        //     'nopeg' => 'required',
        //     // 'password' => 'required',
        //     'id_pengubah' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return $this->sendError('Validation Error.', $validator->errors());
        // }

        $pegawai = Pegawai::find($id);

        if (is_null($pegawai)) {
            return $this->sendError('Profile not found.');
        }

        $find = User::where('email', $input['pegawai']['email']);
        $user = User::find($id);

        if ($find->count() != 0 && $find->first()->email != $user->email) {
            return $this->sendError('Email Already Exist');
        }


        $user->name = $input['pegawai']['nama'];
        $user->email = $input['pegawai']['email'];
        // $user->password = Hash::make($input['password']);
        $pegawai->nama = $input['pegawai']['nama'];
        $pegawai->nip = $input['pegawai']['nopeg'];
        $pegawai->tempat_lahir = $input['pegawai']['tempatLahir'];
        $pegawai->tanggal_lahir = $input['pegawai']['tanggalLahir'];
        // $pegawai->no_telp = $input['pegawai']['no_telp'];
        $pegawai->no_telp = NULL;
        $pegawai->id_kelompok_kompetensi = $input['pegawai']['kompetensi']['id'];
        $pegawai->id_pengubah = Auth::user()->id;

        $imageData = $input['pegawai']['imageProfileUrl'];

        if(explode("/", $imageData)[0] === "data:image"){
            $extension = explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
            $fileName =  $pegawai->nip . '.' . $extension;
            $image = Image::make($imageData);   
            $image->save(public_path('profile/').$fileName);
            ImageOptimizer::optimize(public_path('profile/').$fileName);
        }else{
            $extension = explode(".", $imageData)[1];
        }

        $pegawai->ekstensi_foto = $extension;


        $kepegawaian = DataKepegawaian::where('id_pegawai', $id);

        if($kepegawaian->count() === 0){
            $postDataKepegawaian = DataKepegawaian::create([
                'id_pegawai' => $id,
                'id_unit_kerja' => $input['data_kepegawaian'][0]['id_unit_kerja'],
                'id_posisi' => $input['data_kepegawaian'][0]['id_posisi'],
                'tahun_masuk' => $input['data_kepegawaian'][0]['tahun_masuk'],
                'tahun_keluar' => $input['data_kepegawaian'][0]['tahun_keluar'],
            ]);
        }else{
            $count = count($input['data_kepegawaian']);
            $kepegawaian_new = DataKepegawaian::find($input['data_kepegawaian'][$count-1]['id_data_kepegawaian']);

            $kepegawaian_new->id_unit_kerja = $input['data_kepegawaian'][$count-1]['id_unit_kerja'];
            $kepegawaian_new->id_posisi = $input['data_kepegawaian'][$count-1]['id_posisi'];
            $kepegawaian_new->tahun_masuk = $input['data_kepegawaian'][$count-1]['tahun_masuk'];
            $kepegawaian_new->tahun_keluar = $input['data_kepegawaian'][$count-1]['tahun_keluar'];
            $kepegawaian_new->save();
        }

        $user->save();
        $pegawai->save();

        $data = array_merge(
            $user->toArray(),
            $pegawai->toArray(),
            $kepegawaian->get()->toArray()
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

        foreach ($pegawai_rows as $pegawai_row) {
            $pegawai_array[] = get_object_vars($pegawai_row);
        }

        $timestamp = Carbon::now()->toDateTimeString();
        $filename = 'pegawai_' . $timestamp;

        $storagePath = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $path = $storagePath . 'templates/pegawai_template_export.xlsx';

        Excel::load($path, function ($excel) use ($pegawai_array, $timestamp) {
            $excel->setTitle('Data Pegawai ' . $timestamp);

            $excel->sheet('sheet1', function ($sheet) use ($pegawai_array) {
                $sheet->fromArray($pegawai_array, null, 'A2', false, false);
            });
        })->setFilename('pegawai_' . $timestamp)->download('xlsx');
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
                $auth = PMO::find($session_id);
                if (is_null($auth)) {
                    $auth = Admin::find($session_id);
                }
                break;

            case 6:
                $auth = User::find($session_id);
                break;
        }

        if (is_null($auth)) {
            return false;
        }

        return true;
    }
}