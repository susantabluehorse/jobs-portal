<?php

namespace App\Http\Controllers;

use App\CompanyProfile;
use App\Http\Controllers\ExtraController;
use Illuminate\Http\Request;
use App\Job;
use App\JobCategory;
use App\User;
use App\Profile;
use App\Skill;
use App\Education;
Use App\Work;
use Image;
use DB;
use Illuminate\Support\Facades\Validator;


class CompanyprofileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function profile() {
        if(Auth()->user()->role !== 2) {
            return redirect('/')->with('error', 'Unauthorize Page');
        }
        $user_id = Auth()->user()->id;
        $user = User::find($user_id);
        $profile = CompanyProfile::where('user_id', $user->id)->first();
        return view('company.profile', compact('user', 'profile'));
    }

    public function updateProfile(Request $request){
        if(Auth()->user()->role !== 2) {
            return redirect('/')->with('error', 'Unauthorize Page');
        }
        $id = Auth()->user()->id;
        $user = User::find($id);
        $profile = CompanyProfile::where('user_id', $id)-> first();
        /*dd($profile);*/
        $errMsgs = [
            'name.required' => 'Please Enter Your Company Name',
            'location.required' => 'Please Enter Your Company Location',
            'contact_person.required' => 'Please Enter Your Company Contact Person',
            'description.required' => 'Please Enter Your Company Details',
        ];
        $validation_expression = [
            'name' => 'required',
            'location' => 'required',
            'contact_person' => 'required',
            'description' => 'required',
        ];
        $validator = Validator::make($request->all(), $validation_expression, $errMsgs);
        if(!$validator->fails()):
            $data= $validator->validate();
        /*dd($data);*/
            /*dd($data);*/
            if ($profile == null):
                /*dd("profile nei");*/
                $data['user_id'] = $user->id;
                /*dd($data);*/
                $profile = CompanyProfile::create($data);
            else:
                $profile = CompanyProfile::find($id)->update($data);
            endif;

            if($profile):
                return redirect()->back()->with('success','successfully created!');
            endif;
            return redirect()->back()->with('error','can\'t create, please try again!')->withInput();
        else:
            return redirect()->back()->withErrors($validator->errors())->withInput();
        endif;
    }

    public function updatePhoto(Request $request){
        if(Auth()->user()->role !== 2) {
            return redirect('/')->with('error', 'Unauthorize Page');
        }
        $id = Auth()->user()->id;
        $user = User::find($id);
        $profile = CompanyProfile::where('user_id', $id)-> first();
        $errMsgs = [
            'photo.required' => 'Please Enter Your Company Name',
        ];
        $validation_expression = [
            'photo' => 'required',
        ];
        $validator = Validator::make($request->all(), $validation_expression, $errMsgs);
        if(!$validator->fails()):
            $data= $validator->validate();
            $data['photo'] = ExtraController::savePhoto($request->photo);
            if ($profile == null):
                /*dd("profile nei");*/
                $data['user_id'] = $user->id;
                /*dd($data);*/
                $profile = CompanyProfile::create($data);
            else:
                $profile = CompanyProfile::find($id)->update($data);
            endif;

            if($profile):
                return redirect()->back()->with('success','successfully created!');
            endif;
            return redirect()->back()->with('error','can\'t create, please try again!')->withInput();
        else:
            return redirect()->back()->withErrors($validator->errors())->withInput();
        endif;

    }
}
