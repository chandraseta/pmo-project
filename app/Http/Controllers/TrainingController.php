<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Pegawai;
use App\PMO;
use App\Training;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class TrainingController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!$this->authenticate(2)) {
            return $this->sendError('You are not authenticated.');
        }

        $data = DB::table('training')->get();

        return $this->sendResponse($data->toArray(), 'Data Training retrieved successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        $input = $request->all();

        $validator = Validator::make($input, [
            'nama_training' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $postTraining = Training::create([
            'nama_training' => $input['nama_training'],
        ]);

        return $this->sendResponse($postTraining, 'Training created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function show($id_training)
    {
        if (!$this->authenticate(2)) {
            return $this->sendError('You are not authenticated.');
        }

        $training = Training::find($id_training);

        return $this->sendResponse($training, 'Training retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training)
    {
        if (!$this->authenticate(2)) {
            return $this->sendError('You are not authenticated.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_training)
    {
        if (!$this->authenticate(2)) {
            return $this->sendError('You are not authenticated.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'nama_training' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $find = Training::where('id_training', $id_training);

        if ($find->count() == 0) {
            return $this->sendError('ID Training not found.');
        }

        $training = Training::find($id_training);
        $training->nama_training = $input['nama_training'];

        $training->save();

        return $this->sendResponse($training, 'Training updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_training)
    {
        if (!$this->authenticate(2)) {
            return $this->sendError('You are not authenticated.');
        }

        $training = Training::find($id_training);

        if (is_null($training)) {
            return $this->sendError('Training not found');
        }

        $training->delete();

        return $this->sendResponse($id_training, 'Training deleted successfully');
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
