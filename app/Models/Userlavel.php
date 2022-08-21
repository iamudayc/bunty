<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userlavel extends Model
{
    protected $table = 'user_level';

    public function childs() {

        return $this->hasMany('App\Models\Userlavel','parent_id','id') ;

    }
}
