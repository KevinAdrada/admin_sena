<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $fillable = [
        'course_number',
        'day',
        'area_id',
        'training_center_id'
    ];

    use HasFactory;
    public function apprentices(){
        return $this->hasMany('App\Models\Apprentice');
    }

    public function training_center(){
        return $this->belongsTo('App\Models\Training_center');
    }

    public function area(){
        return $this->belongsTo('App\Models\Area');
    }

    public function teachers(){
        return $this->belongsToMany('App\Models\Teacher');
    }
}
