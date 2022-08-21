<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $table = 'live_market';

    /*public function childs() {

        return $this->hasMany('App\Models\Userlavel','parent_id','id') ;

    }*/
}
