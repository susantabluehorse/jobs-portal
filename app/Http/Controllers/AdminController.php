<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Job;
use App\Skill;
use App\Applicant;
use App\JobCategory;
use App\Course;
use App\Grids\JobseekersGrid;
use App\Grids\CompanyGrid;
use App\Grids\JobsGrid;
use App\Grids\ApplicantsGrid;
use App\Grids\CategoryGrid;
use App\Grids\SkillsGrid;
use App\Grids\CourseGrid;
use Session;
class AdminController extends Controller
{
   
    public function showJobseekers(Request $request) {
        $grid = JobseekersGrid::get();
        if ($request->ajax()) {
            return $grid;
        }
        return view('admin.jobseekers', compact('grid'));
    }

    public function banJobseeker(Request $request) {
    	$id = $request->id;
    	$user = User::find($id);
    	$user->status = '0';
    	$user->save();
    }

    public function unbanJobseeker(Request $request) {
    	$id = $request->id;
    	$user = User::find($id);
    	$user->status = '1';
    	$user->save();
    }

    public function showCompany(Request $request) {
    	$grid = CompanyGrid::get();
        if ($request->ajax()) {
            return $grid;
        }
    	return view('admin.company', compact('grid'));
    }
		
	public function unbanCompany(Request $request) {
    	$id = $request->id;
    	$user = User::find($id);
    	$user->status = '1';
    	$user->save();
    }

    public function showJobs(Request $request) {
    	$grid = JobsGrid::get();
        if ($request->ajax()) {
            return $grid;
        }
        return view('admin.jobs', compact('grid'));
    }

    public function viewJobs(Request $request, $id) {
        session(['job_id' => $id]);
        $job = Job::find($id);
        $grid = ApplicantsGrid::get($id);
        if ($request->ajax()) {
            return $grid;
        }
        return view('admin.applicants', compact('grid','job'));
    }

    public function sendApplicant(Request $request)
    {
        $id = $request->id;
        $applicant = Applicant::find($id);
        $applicant->status = $request->status;
        $applicant->save();
    }

    public function banJobs(Request $request) {
        $id = $request->id;
        $user = Job::find($id);
        $user->status = '0';
        $user->save();
    }

    public function unbanJobs(Request $request) {
        $id = $request->id;
        $Job = Job::find($id);
        $Job->status = '1';
        $Job->save();
    }

    public function deleteJob($id)
    {
       $job = Job::findOrFail($id);    
       $job->delete();
    }

    public function showCategories(Request $request) {
        $grid = CategoryGrid::get();
        if ($request->ajax()) {
            return $grid;
        }
        return view('admin.categories', compact('grid'));
    }

    public function addCategories(Request $request) {
        if(!empty($request->category_name)){
            $category = JobCategory::where('category_name','=',$request->category_name)->get()->toArray();
            if(empty($category->item)){
                $category = new JobCategory;
                $category->category_name = $request->category_name;
                $category->save();
                $data = array('msg'=>'Category create Successfully','status'=>'1');
            } else {
                $data = array('msg'=>'Category already exits','status'=>'0');
            }
        } else {
            $data = array('msg'=>'Required category name','status'=>'0');
        }
        return json_encode($data);
    }

    public function banCategories(Request $request) {
        $id = $request->id;
        $jobCategory = JobCategory::find($id);
        $jobCategory->status = '0';
        $jobCategory->save();
    }

    public function unbanCategories(Request $request) {
        $id = $request->id;
        $jobCategory = JobCategory::find($id);
        $jobCategory->status = '1';
        $jobCategory->save();
    }

    public function showSkills(Request $request) {
        $grid = SkillsGrid::get();
        if ($request->ajax()) {
            return $grid;
        }
        return view('admin.skills', compact('grid'));
    }

    public function addSkills(Request $request) {
        if(!empty($request->skill)){
            $skill = Skill::where('skill','=',$request->skill)->get()->toArray();
            if(empty($skill)){
                $skill = new Skill;
                $skill->skill = $request->skill;
                $skill->save();
                $data = array('msg'=>'Skill create Successfully','status'=>'1');
            } else {
                $data = array('msg'=>'Skill already exits','status'=>'0');
            }
        } else {
            $data = array('msg'=>'Required skill name','status'=>'0');
        }
        return json_encode($data);
    }

    public function banSkills(Request $request) {
        $id = $request->id;
        $skill = Skill::find($id);
        $skill->status = '0';
        $skill->save();
    }

    public function unbanSkills(Request $request) {
        $id = $request->id;
        $skill = Skill::find($id);
        $skill->status = '1';
        $skill->save();
    }

    public function showCourses(Request $request) {
        $grid = CourseGrid::get();
        if ($request->ajax()) {
            return $grid;
        }
        return view('admin.courses', compact('grid'));
    }

    public function addCourses(Request $request) {
        if(!empty($request->name)){
            $course = Course::where('name','=',$request->name)->get()->toArray();
            if(empty($course)){
                $course = new Course;
                $course->name = $request->name;
                $course->save();
                $data = array('msg'=>'Course create Successfully','status'=>'1');
            } else {
                $data = array('msg'=>'Course already exits','status'=>'0');
            }
        } else {
            $data = array('msg'=>'Required course name','status'=>'0');
        }
        return json_encode($data);
    }

    public function banCourses(Request $request) {
        $id = $request->id;
        $course = Course::find($id);
        $course->status = '0';
        $course->save();
    }

    public function unbanCourses(Request $request) {
        $id = $request->id;
        $course = Course::find($id);
        $course->status = '1';
        $course->save();
    }
}