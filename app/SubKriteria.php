<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kriteria;
use App\NilaiCalonPendamping;

class SubKriteria extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function kriteria(){
        return $this->belongsTo(Kriteria::class,'id_kriteria');
    }

    public function c1(){
        return $this->hasMany(NilaiCalonPendamping::class,'c1');
    }
}
