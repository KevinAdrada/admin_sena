<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course; 
use App\Models\Training_center; 
use App\Models\Area; 

class CourseController extends Controller
{
    public function index(){
        $courses = Course::orderBy('id', 'asc')->get();
        return view('course.index', compact('courses')); 
    }

    public function create(){
        $training_centers = Training_center::all();
        $areas = Area::all();
        return view('course.create', compact('training_centers', 'areas')); 
    }

    public function show (Course $course){
        return view('course.show',compact('course'));
    }

    public function store(Request $request){
        Course::create($request->all());
        return redirect()->route('course.index');
    }

    public function edit(Course $course){
        $training_centers = Training_center::all();
        $areas = Area::all();
        return view('course.edit', compact('course', 'training_centers', 'areas'));
    }

    public function update(Request $request, Course $course){
        $course->update($request->all());
        return redirect()->route('course.index');
    }
}
