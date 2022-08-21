<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    public function userDetails() {

        return $this->hasOne('App\Models\Users','id','provide_by') ;

    }
}
