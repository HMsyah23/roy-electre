<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CalonPendamping;
use App\Subkriteria;

class NilaiCalonPendamping extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function pendamping(){
        return $this->belongsTo(CalonPendamping::class,'id_pendamping');
    }

    public function c1(){
        return $this->belongsTo(Subkriteria::class,'C1');
    }

    public function c2(){
        return $this->belongsTo(Subkriteria::class,'C2');
    }

    public function c3(){
        return $this->belongsTo(Subkriteria::class,'C3');
    }

    public function c4(){
        return $this->belongsTo(Subkriteria::class,'C4');
    }

    public function c5(){
        return $this->belongsTo(Subkriteria::class,'C5');
    }
}
