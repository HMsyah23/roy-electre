<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\NilaiCalonPaskibraka;

class CalonPaskibraka extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function relasis()
    {
        return $this->hasMany(NilaiCalonPaskibraka::class,'paskibraka_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    //define accessor
    public function getUmurAttribute()
    {
        return date_diff(date_create($this->tanggal_lahir), date_create('now'))->y.' Tahun';
    }

    public function getBmiAttribute()
    {
        $tinggi = $this->tinggi_badan / 100;
        $tinggi = $tinggi * $tinggi;
        $bmi = $this->berat_badan / $tinggi; 

        return round($bmi, 2);
    }
}
