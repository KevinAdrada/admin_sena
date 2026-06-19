<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    protected $fillable = [
        'name',
        'email',
        'area_id',
        'training_center_id'
    ];


    use HasFactory;
    public function training_center(){
        return $this->belongsTo('App\Models\Training_center');
    }

    public function area(){
        return $this->belongsTo('App\Models\Area');
    }

    public function courses(){
        return $this->belongsToMany('App\Models\Course');
    }
}
