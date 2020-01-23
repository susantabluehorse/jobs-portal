<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request) {

    	// $this->validate($request, [
     //        'position' => 'required',
     //        'company' => 'required',
     //        'year' => 'required'
     //    ]);

    	$new_project = new Project();
    	$new_project->name = $request->name;
    	$new_project->duration = $request->duration;
    	$new_project->role = $request->role;    	
        $new_project->company_name = $request->company_name;
        $new_project->description = $request->description;
    	$new_project->user_id = auth()->user()->id; 
    	$new_project->save();
    }

    public function update(Request $request) {    	
     	$id = $request->id;
    	$project = Project::find($id);
        $project->name = $request->name;
    	$project->duration = $request->duration;
    	$project->role = $request->role;    	
        $project->company_name = $request->company_name;
        $project->description = $request->description;
    	$project->save();
    }

    public function delete(Request $request) { 
    	$id = $request->id;
   		Project::findOrFail($id)->delete(); 
    }
}
