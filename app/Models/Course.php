<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_type',
        'course_name',
        'course_number',
        'start_date',
        'end_date',
        'environment_id',
    ];

    public function apprentices()
    {
        return $this->hasMany(Apprentice::class);
    }

    public function environment()
    {
        return $this->belongsTo(Environment::class);
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }
}