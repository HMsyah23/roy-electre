<?php

namespace App;

use App\CalonPendamping;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    public $timestamps = false;
    protected $guarded = [];

    public function pendamping()
    {
        return $this->hasOne(CalonPendamping::class,'id_user');
    }

}
