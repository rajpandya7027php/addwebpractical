<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anylyticdata extends Model
{
    //
    protected $fillable = [
        'analytic_id ','link_id', 'userAgent','user_id','ip','created_at'
    ];
}
