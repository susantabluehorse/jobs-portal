<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $guarded = [];

    protected $table = 'company_profiles';
    function user() {
        return $this->belongsTo('App\User');
    }
}
