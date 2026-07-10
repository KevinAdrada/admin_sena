<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area; 

class AreaController extends Controller
{
    public function index(){
        $areas = Area::orderBy('id', 'asc')->get();
        return view('area.index', compact('areas')); 
    }

    public function show (Area $area){
        return view('area.show',compact('area'));
    }

    public function create(){
        return view('area.create'); 
    }

    public function store(Request $request){
        Area::create($request->all());

        return redirect()->route('area.index');
    }

    public function edit(Area $area){
        return view('area.edit', compact('area'));
    }

    public function update(Request $request, Area $area){
        $area->update($request->all());
        return redirect()->route('area.index');
    }

    public function destroy(Area $area){
        $area->delete();
        return redirect()->route('area.index');
    }
}