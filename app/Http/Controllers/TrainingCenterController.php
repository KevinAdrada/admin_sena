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
        $training_center = Training_center::create($request->all());

        return $training_center; 
    }
}
