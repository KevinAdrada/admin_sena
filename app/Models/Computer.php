<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'brand',
        'environment_id',
    ];

    public function environment()
    {
        return $this->belongsTo(Environment::class);
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}