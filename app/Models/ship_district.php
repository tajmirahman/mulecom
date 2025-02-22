<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ship_district extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function division(){
        return $this->belongsTo(ship_division::class, 'division_id','id');
    }

}
