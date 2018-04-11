<?php


namespace App\Http\Controllers\User;


use Illuminate\Http\Request;
use App\Http\Controllers\APIBaseController as APIBaseController;
use App\Education;
use App\Employment;
use App\Experience;
use App\Performance;
use App\Profile;
use App\User;
use Validator;
use Illuminate\Support\Facades\Hash;


class UserAPIController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = User::all();
        return $this->sendResponse($posts->toArray(), 'User retrieved successfully.');
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


        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $find = User::where('email', $input['email'])->count();

        if($find != 0){
            return $this->sendError('Email already exist');
        }

        $postUser = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $post = array_merge($postUser->toArray());

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
        $post = User::find($id);


        if (is_null($post)) {
            return $this->sendError('User not found.');
        }


        return $this->sendResponse($post->toArray(), 'User retrieved successfully.');
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $post = User::find($id);

        if (is_null($post)) {
            return $this->sendError('User not found.');
        }

        $user = User::find($id);

        if(!is_null($input['name'])){
            $user->name = $input['name'];
        }

        if(!is_null($input['email'])){
            $user->email = $input['email'];
        }

        if(!is_null($input['password'])){
            $user->password = Hash::make($input['password']);
        }

        $user->save();

        $data = array_merge(
            $user->toArray()
        );

        return $this->sendResponse($data, 'User updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return $this->sendError('User not found.');
        }

        $user->delete();

        // TODO: Delete all user-related data

        return $this->sendResponse($id, 'User deleted successfully.');
    }
}