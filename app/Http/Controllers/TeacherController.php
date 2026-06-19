<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher; 
use App\Models\Area; 
use App\Models\Training_center; 

class TeacherController extends Controller
{
    public function create(){
        $training_centers = Training_center::all();
        $areas = Area::all();

        return view('teacher.create', compact('areas', 'training_centers')); 
    }

    public function store(Request $request){
        $teacher = Teacher::create($request->all());

        return $teacher;
    }
}
