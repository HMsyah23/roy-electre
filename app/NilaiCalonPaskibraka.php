<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CalonPaskibraka;
use App\Subkriteria;

class NilaiCalonPaskibraka extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function paskibraka(){
        return $this->belongsTo(CalonPaskibraka::class);
    }

    public function subKriteria()
    {
        return $this->belongsTo(SubKriteria::class);
    }
}
