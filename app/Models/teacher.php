<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_cargo',
        'tipo_cuentadante',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }
}
