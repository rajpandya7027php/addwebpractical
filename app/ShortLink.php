<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Anylyticdata;
class ShortLink extends Model
{
    //
     protected $fillable = [
        'id','code', 'link','created_date','modify_date'
    ];
    public function anylyticdata() {
	    return $this->hasManyThrough(Anylyticdata::class);
	}
}
