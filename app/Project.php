<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    protected $table = 'projects';
    function user() {
        return $this->belongsTo('App\User');
    }
}
