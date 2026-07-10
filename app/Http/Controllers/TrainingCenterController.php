<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training_center; 

class TrainingCenterController extends Controller
{
    public function index(){
        $training_centers = Training_center::orderBy('id', 'asc')->get();
        return view('training_center.index', compact('training_centers')); 
    }

    public function create(){
        return view('training_center.create'); 
    }

    public function show (Training_center $training_center){
        return view('training_center.show',compact('training_center'));
    }

    public function store(Request $request){
        Training_center::create($request->all());
        return redirect()->route('training_center.index');
    }

    public function edit(Training_center $training_center){
        return view('training_center.edit', compact('training_center'));
    }

    public function update(Request $request, Training_center $training_center){
        $training_center->update($request->all());
        return redirect()->route('training_center.index');
    }
}
