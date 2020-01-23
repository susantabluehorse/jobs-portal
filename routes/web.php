<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Auth::routes();
// Page Controller
Route::get('/', 'PageController@index');
// Job Controller
Route::resource('/jobs', 'JobController');
/*Route::get('/jobs/delete/{id}', 'JobController@destroy')->name('job-delete');*/
// job seeker Controller
Route::get('/userdashboard', 'JobseekerController@index');
Route::post('/profile/store', 'JobseekerController@storeProfile');
Route::post('/profile/edit', 'JobseekerController@updateProfile');
Route::post('/profile/uploadphoto', 'JobseekerController@uploadPhoto');
Route::post('/profile/updatephoto', 'JobseekerController@updatePhoto');
Route::get('/profile/{name}', 'JobseekerController@profile');
Route::get('/my-jobs', 'JobseekerController@myJobs');
/*Jyotirmoy coad starts*/
Route::prefix('profile')->name('profile')->group(function () {
    Route::post('/cv','JobseekerController@cv')->name('.cv');
    Route::post('/project-add','JobseekerController@AddProject')->name('.project-add');
});
/*Jyotirmoy coad end*/
// Skill Controller
Route::post('/profile/skills/store', 'SkillController@storeSkill');
Route::post('/profile/skills/edit', 'SkillController@editSkill');
// Education Controller
Route::post('/profile/education/store', 'EducationController@storeEducation');
Route::post('/profile/education/update', 'EducationController@updateEducation');
Route::post('/profile/education/delete', 'EducationController@deleteEducation');
// Client Controller
Route::get('/dashboard', 'CompanyController@dashboard');
Route::get('/shortlist/{id}', 'CompanyController@shortlist');
Route::get('/proposal/{id}/{user_id}', 'CompanyController@proposal');
Route::get('/proposal/{id}/{user}/hire', 'CompanyController@hire');
Route::get('/proposal/{id}/{user}/reject', 'CompanyController@reject');

/*Company Profile starts*/
Route::prefix('company-profile')->name('company-profile')->group(function () {
    Route::get('show','CompanyprofileController@profile')->name('.show');
    Route::post('edit', 'CompanyprofileController@updateProfile')->name('.edit');
    Route::post('photo', 'CompanyprofileController@updatePhoto')->name('.photo');
});
/*Company Profile end*/
// Work Controller
Route::post('/profile/work/store', 'WorkController@storeWork');
Route::post('/profile/work/update', 'WorkController@updateWork');
Route::post('/profile/work/delete', 'WorkController@deleteWork');
// project Controller
Route::post('/profile/project/store', 'ProjectController@store');
Route::post('/profile/project/update', 'ProjectController@update');
Route::post('/profile/project/delete', 'ProjectController@delete');
// Applicant Controller
Route::get('/job/application/{id}', 'ApplicantController@show');
Route::post('/job/application/{id}/store', 'ApplicantController@store');
Route::get('/applicant/profile/{id}', 'ApplicantController@view');
// Admin Controller
Route::get('/admin/jobseeker', 'AdminController@showJobseekers');
Route::post('/admin/users/ban', 'AdminController@banJobseeker');
Route::post('/admin/jobseeker/unban', 'AdminController@unbanJobseeker');
Route::get('/admin/company', 'AdminController@showCompany');
Route::post('/admin/company/unban', 'AdminController@unbanCompany');
Route::get('/admin/jobs', 'AdminController@showJobs');
Route::post('/admin/jobs/ban', 'AdminController@banJobs');
Route::post('/admin/jobs/unban', 'AdminController@unbanJobs');
Route::get('/admin/jobs/delete/{id}', 'AdminController@deleteJob');
Route::get('/admin/jobs/view/{id}', 'AdminController@viewJobs');
Route::post('/admin/jobs/send/applicant', 'AdminController@sendApplicant');
Route::get('/admin/categories', 'AdminController@showCategories');
Route::post('/admin/categories/add', 'AdminController@addCategories');
Route::post('/admin/categories/ban', 'AdminController@banCategories');
Route::post('/admin/categories/unban', 'AdminController@unbanCategories');
Route::get('/admin/skills', 'AdminController@showSkills');
Route::post('/admin/skills/add', 'AdminController@addSkills');
Route::post('/admin/skills/ban', 'AdminController@banSkills');
Route::post('/admin/skills/unban', 'AdminController@unbanSkills');
Route::get('/admin/courses', 'AdminController@showCourses');
Route::post('/admin/courses/add', 'AdminController@addCourses');
Route::post('/admin/courses/ban', 'AdminController@banCourses');
Route::post('/admin/courses/unban', 'AdminController@unbanCourses');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
