<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apprentice extends Model
{
    use HasFactory;

    public function computer(){
        return $this->belongsTo('App\Models\Computer');
    }
    
    public function course(){
        return $this->belongsTo('App\Models\Course');
    }

}
