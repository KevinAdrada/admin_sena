<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training_center;

class TrainingCenterController extends Controller
{
    public function index()
    {
        $training_centers = Training_center::orderBy('id', 'asc')->get();
        return view('training_center.index', compact('training_centers'));
    }

    public function create()
    {
        return view('training_center.create');
    }

    public function show(Training_center $training_center)
    {
        $training_center->load('environments', 'images');
        return view('training_center.show', compact('training_center'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $center = Training_center::create($request->all());

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreArchivo = "center_" . time() . "." . $file->guessExtension();
            $file->storeAs('images', $nombreArchivo, 'public');

            $center->images()->create([
                'imagen' => $nombreArchivo,
            ]);
        }

        return redirect()->route('training_center.index')
            ->with('success', 'Centro creado correctamente');
    }


    public function edit(Training_center $training_center)
    {
        return view('training_center.edit', compact('training_center'));
    }

    public function update(Request $request, Training_center $training_center)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'imagenes.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $training_center->update($request->all());

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $file) {
                $nombreArchivo = "center_" . time() . "_" . uniqid() . "." . $file->guessExtension();
                $file->storeAs('images', $nombreArchivo, 'public');

                $training_center->images()->create([
                    'imagen' => $nombreArchivo,
                ]);
            }
        }

        return redirect()->route('training_center.index')
            ->with('success', 'Centro actualizado correctamente');
    }

    public function destroy(Training_center $training_center)
    {
        $training_center->delete();
        return redirect()->route('training_center.index');
    }
}
