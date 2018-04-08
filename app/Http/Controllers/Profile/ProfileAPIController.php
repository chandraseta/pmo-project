<?php


namespace App\Http\Controllers\Profile;


use Illuminate\Http\Request;
use App\Http\Controllers\Profile\APIBaseController as APIBaseController;
use App\Education;
use App\Employment;
use App\Experience;
use App\Performance;
use App\Profile;
use App\User;
use Validator;
use Illuminate\Support\Facades\Hash;


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
            'password' => 'required',
            'nip' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $find = User::where('email', $input['email'])->count();

        if($find != 0){
            return $this->sendError('Email Already Exist');
        }

        $postUser = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $postProfile = Profile::create([
            'name' => $input['name'],
            'nip' => $input['nip'],
            'birth_place' => $input['birth_place'],
            'birth_date' => $input['birth_date'],
        ]);

        $post = array_merge($postUser->toArray(), $postProfile->toArray());

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
            'nip' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $post = User::find($id);

        if (is_null($post)) {
            return $this->sendError('Profile not found.');
        }

        $user = User::find($id);
        $profile = Profile::find($id);

        if(!is_null($input['name'])){
            $user->name = $input['name'];
            $profile->name = $input['name'];
        }

        if(!is_null($input['email'])){
            $user->email = $input['email'];
        }

        if(!is_null($input['password'])){
            $user->password = Hash::make($input['password']);
        }

        if(!is_null($input['nip'])){
            $profile->nip = $input['nip'];
        }

        if(!is_null($input['birth_place'])){
            $profile->birth_place = $input['birth_place'];
        }

        if(!is_null($input['birth_date'])){
            $profile->birth_date = $input['birth_date'];
        }

        $performance = Performance::where('user_id', $user->id);

        if($performance->count() > 0){
            $performance->delete();
        }

        for($i = 1; $i <= $input['performance_counter']; $i++){
            $postPerformance = Performance::create([
                'user_id' => $user->id,
                'date' => $input['performance_date_' . $i],
                'purpose' => $input['performance_purpose_' . $i],
                'performance_report' => $input['performance_report_' . $i],
            ]);
        }

        $education = Education::where('user_id', $user->id);

        if($education->count() > 0){
            $education->delete();
        }

        for($i = 1; $i <= $input['education_counter']; $i++){
            $postEducation = Education::create([
                'user_id' => $user->id,
                'degree' => $input['education_degree_' . $i],
                'institution' => $input['education_institution_' . $i],
                'major' => $input['education_major_' . $i],
                'start_year' => $input['education_start_year_' . $i],
                'end_year' => $input['education_end_year_' . $i],
            ]);
        }

        $employment = Employment::where('user_id', $user->id);

        if($employment->count() > 0){
            $employment->delete();
        }

        for($i = 1; $i <= $input['employment_counter']; $i++){
            $postEmployment = Employment::create([
                'user_id' => $user->id,
                'competency' => $input['employment_competency_' . $i],
                'unit' => $input['employment_unit_' . $i],
                'position' => $input['employment_position_' . $i],
                'start_year' => $input['employment_start_year_' . $i],
                'end_year' => $input['employment_end_year_' . $i],
            ]);
        }

        $experience = Experience::where('user_id', $user->id);

        if($experience->count() > 0){
            $experience->delete();
        }

        for($i = 1; $i <= $input['experience_counter']; $i++){
            $postExperience = Experience::create([
                'user_id' => $user->id,
                'institution' => $input['experience_institution_' . $i],
                'position' => $input['experience_position_' . $i],
                'start_year' => $input['experience_start_year_' . $i],
                'end_year' => $input['experience_end_year_' . $i],
            ]);
        }

        $user->save();
        $profile->save();

        $data = array_merge(
            $user->toArray(),
            $profile->toArray(),
            $performance->get()->toArray(),
            $education->get()->toArray(),
            $employment->get()->toArray(),
            $experience->get()->toArray()
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
        $user = User::find($id);

        if (is_null($user)) {
            return $this->sendError('Profile not found.');
        }

        $user->delete();


        $profile = Profile::find($id);

        if (is_null($profile)) {
            return $this->sendError('Profile not found.');
        }

        $profile->delete();


        $performance = Performance::where('user_id', $user->id);

        if($performance->count() > 0){
            $performance->delete();
        }


        $education = Education::where('user_id', $user->id);

        if($education->count() > 0){
            $education->delete();
        }


        $employment = Employment::where('user_id', $user->id);

        if($employment->count() > 0){
            $employment->delete();
        }


        $experience = Experience::where('user_id', $user->id);

        if($experience->count() > 0){
            $experience->delete();
        }


        return $this->sendResponse($id, 'Tag deleted successfully.');
    }
}