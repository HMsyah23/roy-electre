<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\NilaiCalonPendamping;

class CalonPendamping extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function relasis()
    {
        return $this->hasMany(NilaiCalonPendamping::class,'id_pendamping');
    }

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
}
