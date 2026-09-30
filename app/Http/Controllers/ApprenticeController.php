<?php

namespace App\Http\Controllers;

use App\Models\Apprentice;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ApprenticeController extends Controller
{
    public function index()
    {
        $apprentices = Apprentice::with(['user', 'course', 'images'])->get();
        return view('apprentice.index', compact('apprentices'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('apprentice.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'documento' => 'required|string|unique:users,documento',
            'email'     => 'required|email|unique:users,email',
            'celular'   => 'required|string|max:20',
            'password'  => 'required|string|min:6',
            'estado'    => 'required|in:en formacion,desercion,retiro voluntario',
            'etapa'     => 'nullable|required_if:estado,en formacion|in:lectiva,practica',
            'course_id' => 'required|exists:courses,id',
            'imagen'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name'      => $request->name,
                'documento' => $request->documento,
                'email'     => $request->email,
                'celular'   => $request->celular,
                'rol'       => 'aprendiz',
                'password'  => Hash::make($request->password),
            ]);

            $apprentice = Apprentice::create([
                'user_id'   => $user->id,
                'course_id' => $request->course_id,
                'estado'    => $request->estado,
                'etapa'     => $request->estado === 'en formacion' ? $request->etapa : null,
            ]);

            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $nombreArchivo = "apprentice_" . time() . "." . $file->guessExtension();
                $file->storeAs('images', $nombreArchivo, 'public');

                $apprentice->images()->create([
                    'imagen' => $nombreArchivo,
                ]);
            }
        });

        return redirect()->route('apprentice.index')->with('success', 'Aprendiz creado correctamente.');
    }

    public function show(Apprentice $apprentice)
    {
        $apprentice->load(['user', 'images', 'course']);
        return view('apprentice.show', compact('apprentice'));
    }

    public function edit(Apprentice $apprentice)
    {
        $apprentice->load(['user', 'course', 'images']);
        $courses = Course::all();
        return view('apprentice.edit', compact('apprentice', 'courses'));
    }

    public function update(Request $request, Apprentice $apprentice)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'documento' => 'required|string|unique:users,documento,' . $apprentice->user_id,
            'email'     => 'required|email|unique:users,email,' . $apprentice->user_id,
            'celular'   => 'required|string|max:20',
            'estado'    => 'required|in:en formacion,desercion,retiro voluntario',
            'etapa'     => 'nullable|required_if:estado,en formacion|in:lectiva,practica',
            'course_id' => 'required|exists:courses,id',
            'imagen'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password'  => 'nullable|string|min:6',
        ]);

        DB::transaction(function () use ($request, $apprentice) {
            $userData = [
                'name'      => $request->name,
                'documento' => $request->documento,
                'email'     => $request->email,
                'celular'   => $request->celular,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $apprentice->user->update($userData);

            $apprentice->update([
                'course_id' => $request->course_id,
                'estado'    => $request->estado,
                'etapa'     => $request->estado === 'en formacion' ? $request->etapa : null,
            ]);

            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $nombreArchivo = "apprentice_" . time() . "." . $file->guessExtension();
                $file->storeAs('images', $nombreArchivo, 'public');

                foreach ($apprentice->images as $oldImage) {
                    Storage::disk('public')->delete('images/' . $oldImage->imagen);
                    $oldImage->delete();
                }

                $apprentice->images()->create([
                    'imagen' => $nombreArchivo,
                ]);
            }

            if ($request->has('remove_image')) {
                $imageModel = $apprentice->images->first();
                if ($imageModel) {
                    Storage::disk('public')->delete('images/' . $imageModel->imagen);
                    $imageModel->delete();
                }
            }
        });

        return redirect()->route('apprentice.index')->with('success', 'Aprendiz actualizado correctamente.');
    }

    public function destroy(Apprentice $apprentice)
    {
        DB::transaction(function () use ($apprentice) {
            foreach ($apprentice->images as $image) {
                Storage::disk('public')->delete('images/' . $image->imagen);
                $image->delete();
            }

            $user = $apprentice->user;
            $apprentice->delete();

            if ($user) {
                $user->delete();
            }
        });

        return redirect()->route('apprentice.index')->with('success', 'Aprendiz eliminado correctamente.');
    }
}
