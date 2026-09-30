<?php

namespace App\Http\Controllers;

use App\Models\Environment;
use App\Models\Training_center;
use Illuminate\Http\Request;

class EnvironmentController extends Controller
{
    public function index()
    {
        $environments = Environment::with('trainingCenter')->orderBy('id', 'asc')->get();
        return view('environment.index', compact('environments'));
    }

    public function create()
    {
        $trainingCenters = Training_center::all();
        return view('environment.create', compact('trainingCenters'));
    }

    public function show(Environment $environment)
    {
        return view('environment.show', compact('environment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'training_center_id' => 'required|exists:training_centers,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $environment = Environment::create($request->only(['name', 'location', 'training_center_id']));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $nombreArchivo = "env_" . time() . "." . $file->guessExtension();
            $file->storeAs('images', $nombreArchivo, 'public');

            $environment->images()->create([
                'imagen' => $nombreArchivo,
            ]);
        }

        return redirect()->route('environment.index')
            ->with('success', 'Ambiente creado correctamente.');
    }

    public function edit(Environment $environment)
    {
        $trainingCenters = Training_center::all();
        return view('environment.edit', compact('environment', 'trainingCenters'));
    }

    public function update(Request $request, Environment $environment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'training_center_id' => 'required|exists:training_centers,id',
            'imagenes.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $environment->update($request->only(['name', 'location', 'training_center_id']));

        if ($request->hasFile('imagen')) {
            $environment->images()->delete();

            $file = $request->file('imagen');
            $nombreArchivo = "env_" . time() . "." . $file->guessExtension();
            $file->storeAs('images', $nombreArchivo, 'public');

            $environment->images()->create([
                'imagen' => $nombreArchivo,
            ]);
        }


        return redirect()->route('environment.index')
            ->with('success', 'Ambiente actualizado correctamente.');
    }

    public function destroy(Environment $environment)
    {
        $environment->delete();
        return redirect()->route('environment.index')
            ->with('success', 'Ambiente eliminado correctamente.');
    }
}
