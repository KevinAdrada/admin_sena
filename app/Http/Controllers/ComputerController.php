<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Computer; 

class ComputerController extends Controller
{
    public function create(){
        return view('computer.create'); 
    }

    public function store(Request $request){
        $computer = Computer::create($request->all());

        return $computer;
    }
}
