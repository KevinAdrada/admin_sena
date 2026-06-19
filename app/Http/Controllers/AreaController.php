<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area; 

class AreaController extends Controller
{
    public function create(){
        return view('area.create'); 
    }

    public function store(Request $request){
        $area = Area::create($request->all());

        return $area; 
    }
}