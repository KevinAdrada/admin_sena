<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'training_center_id',
    ];

    public function trainingCenter()
    {
        return $this->belongsTo(Training_center::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'environment_teacher');
    }

    public function computer()
    {
        return $this->hasOne(Computer::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
