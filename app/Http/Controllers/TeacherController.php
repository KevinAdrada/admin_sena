<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher; 
use App\Models\Area; 
use App\Models\Training_center; 

class TeacherController extends Controller
{
    public function index(){
        $teachers = Teacher::orderBy('id', 'asc')->get();
        return view('teacher.index', compact('teachers')); 
    }

    public function create(){
        $training_centers = Training_center::all();
        $areas = Area::all();
        return view('teacher.create', compact('areas', 'training_centers')); 
    }

    public function show (Teacher $teacher){
        return view('teacher.show',compact('teacher'));
    }

    public function store(Request $request){
        Teacher::create($request->all());
        return redirect()->route('teacher.index');
    }

    public function edit(Teacher $teacher){
        $training_centers = Training_center::all();
        $areas = Area::all();
        return view('teacher.edit', compact('teacher', 'training_centers', 'areas'));
    }

    public function update(Request $request, Teacher $teacher){
        $teacher->update($request->all());
        return redirect()->route('teacher.index');
    }

    public function destroy(Teacher $teacher){
        $teacher->delete();
        return redirect()->route('teacher.index');
    }
}
