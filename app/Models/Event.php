<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'event_time',
        'location',
        'training_center_id',
    ];

    public function trainingCenter()
    {
        return $this->belongsTo(Training_center::class, 'training_center_id');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}