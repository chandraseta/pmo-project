<?php


namespace App\Http\Controllers\Profile;


use Illuminate\Http\Request;
use App\Http\Controllers\Profile\APIBaseController as APIBaseController;
use App\Education;
use App\Employment;
use App\Experience;
use App\Performance;
use App\Profile;
use Validator;


class ProfileAPIController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Profile::all();
        return $this->sendResponse($posts->toArray(), 'Profiles retrieved successfully.');
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
            'password' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        $post = Profile::create($input);


        return $this->sendResponse($post->toArray(), 'Profile created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Profile::find($id);


        if (is_null($post)) {
            return $this->sendError('Profile not found.');
        }


        return $this->sendResponse($post->toArray(), 'Profile retrieved successfully.');
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


        $post = Profile::find($id);
        if (is_null($post)) {
            return $this->sendError('Profile not found.');
        }


        $post->name = $input['name'];
        $post->email = $input['email'];
        $post->password = $input['password'];
        $post->save();


        return $this->sendResponse($post->toArray(), 'Profile updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Profile::find($id);


        if (is_null($post)) {
            return $this->sendError('Profile not found.');
        }


        $post->delete();


        return $this->sendResponse($id, 'Tag deleted successfully.');
    }
}