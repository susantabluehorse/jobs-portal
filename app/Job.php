<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Job extends Model
{
	public function category() {
		return $this->belongsTo('App\JobCategory','category_id');
	}

	function user() {
		return $this->belongsTo('App\User','user_id');
	}

	function applicants() {
		return $this->belongsToMany('App\Applicant', 'applicant_job', 'job_id', 'applicant_user_id');
	}
}