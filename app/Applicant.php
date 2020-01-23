<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Applicant extends Model
{
  public $incrementing = false;
  public function jobs() {
    return $this->belongsToMany('App\Job')->withTimeStamps();
  }

  public function user() {
    return $this->belongsTo('App\User');
  }

  public function profile() {
    return $this->hasOne('App\Profile', 'profile');
  }
}