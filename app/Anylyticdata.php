<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ShortLink;
use App\User;

class Anylyticdata extends Model
{
    //
    protected $fillable = [
        'analytic_id ','link_id', 'userAgent','user_id','ip','created_at'
    ];
    public function ShortLink() {
        return $this->belongsTo(ShortLink::class, 'link_id','id');
    }
    public function User() {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
