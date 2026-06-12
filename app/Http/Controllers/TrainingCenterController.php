<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training_center; 

class TrainingCenterController extends Controller
{
    public function create(){
        return view('training_center.create'); 
    }

    public function store(Request $request){
        $training_center = new Training_center();
        $training_center->name = $request->name;
        $training_center->location = $request->location;
        $training_center->save();

        return $training_center;
    }
}
