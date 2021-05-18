<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    //
     protected $fillable = [
        'id','code', 'link','created_date','modify_date'
    ];
}
