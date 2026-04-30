<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    public function courses(){
        return $this->hasMany('App\Models\Course');
    }

    public function teachers(){
        return $this->hasMany('App\Models\Teacher');
    }
}
