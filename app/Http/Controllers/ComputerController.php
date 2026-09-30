<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Models\Environment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComputerController extends Controller
{
    public function index()
    {
        $computers = Computer::with(['environment', 'images'])->orderBy('id', 'asc')->get();
        return view('computer.index', compact('computers'));
    }

    public function create()
    {
        $environments = Environment::all();
        return view('computer.create', compact('environments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|integer|min:1',
            'brand' => 'required|string|max:255',
            'environment_id' => 'required|exists:environments,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $computer = Computer::create($request->only(['number', 'brand', 'environment_id']));

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreArchivo = "computer_" . time() . "." . $file->guessExtension();
            $file->storeAs('images', $nombreArchivo, 'public');

            $computer->images()->create([
                'imagen' => $nombreArchivo,
            ]);
        }

        return redirect()->route('computer.index')->with('success', 'Computadora registrada exitosamente.');
    }

    public function show(Computer $computer)
    {
        $computer->load(['environment', 'images']);
        return view('computer.show', compact('computer'));
    }

    public function edit(Computer $computer)
    {
        $computer->load('images');
        $environments = Environment::all();
        return view('computer.edit', compact('computer', 'environments'));
    }

    public function update(Request $request, Computer $computer)
    {
        $request->validate([
            'number' => 'required|integer|min:1',
            'brand' => 'required|string|max:255',
            'environment_id' => 'required|exists:environments,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $computer->update($request->only(['number', 'brand', 'environment_id']));

        if ($request->hasFile('imagen')) {
            $oldImage = $computer->images()->first();
            if ($oldImage) {
                Storage::disk('public')->delete('images/' . $oldImage->imagen);
                $oldImage->delete();
            }

            $file = $request->file('imagen');
            $nombreArchivo = "computer_" . time() . "." . $file->guessExtension();
            $file->storeAs('images', $nombreArchivo, 'public');

            $computer->images()->create([
                'imagen' => $nombreArchivo,
            ]);
        }

        return redirect()->route('computer.index')->with('success', 'Computadora actualizada exitosamente.');
    }

    public function destroy(Computer $computer)
    {
        foreach ($computer->images as $image) {
            Storage::disk('public')->delete('images/' . $image->imagen);
            $image->delete();
        }

        $computer->delete();

        return redirect()->route('computer.index')->with('success', 'Computadora eliminada exitosamente.');
    }
}