<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];


    public function courses(){
        return $this->belongsToMany(Course::class);
    }

    public function teachers(){
        return $this->hasMany(Teacher::class);
    }
    


}
