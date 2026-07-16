<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Computer; 

class ComputerController extends Controller
{
    public function index(){
        $computers = Computer::orderBy('id', 'asc')->get();
        return view('computer.index', compact('computers')); 
    }

    public function show (Computer $computer){
        return view('computer.show',compact('computer'));
    }

    public function create(){
        return view('computer.create'); 
    }

    public function store(Request $request){
        Computer::create($request->all());
        return redirect()->route('computer.index');
    }

    public function edit(Computer $computer){
        return view('computer.edit', compact('computer'));
    }

    public function update(Request $request, Computer $computer){
        $computer->update($request->all());
        return redirect()->route('computer.index');
    }

    public function destroy(Computer $computer){
        $computer->delete();
        return redirect()->route('computer.index');
    }
}
