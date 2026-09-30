<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with(['user', 'images'])->get();
        return view('teacher.index', compact('teachers'));
    }

    public function create()
    {
        return view('teacher.create');
    }
    public function show(Teacher $teacher)
    {
        return view('teacher.show', compact('teacher'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'documento'        => 'required|string|max:50|unique:users,documento',
            'celular'          => 'required|string|max:20',
            'email'            => 'required|email|max:255|unique:users,email',
            'password'         => 'required|string|min:6',
            'imagen'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'es_cuentadante'   => 'nullable|boolean',
            'tipo_cuentadante' => 'nullable|required_if:es_cuentadante,1|in:planta,contratista',
        ]);

        $user = new User();
        $user->rol = 'instructor'; 
        $user->name = $request->name;
        $user->documento = $request->documento;
        $user->celular = $request->celular;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $tipoCargo = $request->has('es_cuentadante') ? 'cuentadante' : null;
        $tipoCuentadante = $tipoCargo === 'cuentadante' ? $request->tipo_cuentadante : null;

        $teacher = Teacher::create([
            'user_id'          => $user->id,
            'tipo_cargo'       => $tipoCargo,
            'tipo_cuentadante' => $tipoCuentadante,
        ]);

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreArchivo = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images', $nombreArchivo, 'public');

            $teacher->images()->create([
                'imagen' => $nombreArchivo,
            ]);
        }

        return redirect()->route('teacher.index')->with('success', 'Instructor creado correctamente.');
    }

    public function edit(Teacher $teacher)
    {
        return view('teacher.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'documento'        => 'required|string|max:50|unique:users,documento,' . $teacher->user_id,
            'celular'          => 'required|string|max:20',
            'email'            => 'required|email|max:255|unique:users,email,' . $teacher->user_id,
            'password'         => 'nullable|string|min:6',
            'imagen'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'es_cuentadante'   => 'nullable|boolean',
            'tipo_cuentadante' => 'nullable|required_if:es_cuentadante,1|in:planta,contratista',
        ]);

        $userData = [
            'name'      => $request->name,
            'documento' => $request->documento,
            'celular'   => $request->celular,
            'email'     => $request->email,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $teacher->user->update($userData);

        $tipoCargo = $request->has('es_cuentadante') ? 'cuentadante' : null;
        $tipoCuentadante = $tipoCargo === 'cuentadante' ? $request->tipo_cuentadante : null;

        $teacher->update([
            'tipo_cargo'       => $tipoCargo,
            'tipo_cuentadante' => $tipoCuentadante,
        ]);

        if ($request->has('remove_image') || $request->hasFile('imagen')) {
            $imageModel = $teacher->images->first();
            if ($imageModel) {
                Storage::disk('public')->delete('images/' . $imageModel->imagen);
                $imageModel->delete();
            }
        }

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreArchivo = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images', $nombreArchivo, 'public');

            $teacher->images()->create([
                'imagen' => $nombreArchivo,
            ]);
        }

        return redirect()->route('teacher.index')->with('success', 'Instructor actualizado correctamente.');
    }
}
