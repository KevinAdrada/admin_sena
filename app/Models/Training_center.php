<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training_center extends Model
{

    protected $fillable = [
        'name',
        'location',
    ];


    use HasFactory;

    public function environments()
    {
        return $this->hasMany(Environment::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
