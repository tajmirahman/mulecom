<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ship_state extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function division(){
        return $this->belongsTo(ship_division::class, 'division_id','id');
    }

    public function district(){
        return $this->belongsTo(ship_district::class, 'district_id','id');
    }


}
