<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Apprentice;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['admin', 'teacher', 'apprentice'])->orderBy('id', 'asc')->get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('user.create', compact('courses'));
    }

    public function show(User $user)
    {
        $user->load(['admin', 'teacher', 'apprentice.course']);
        return view('user.show', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rol'              => 'required|in:admin,instructor,aprendiz',
            'name'             => 'required|string|max:255',
            'documento'        => 'required|string|max:50|unique:users,documento',
            'email'            => 'required|string|email|max:255|unique:users,email',
            'celular'          => 'required|string|max:20',
            'password'         => 'required|string|min:8|confirmed',
            'imagen'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tipo_cargo_admin' => 'nullable|required_if:rol,admin|in:directivo,subdirectivo,coordinador',
            'es_cuentadante'   => 'nullable|boolean',
            'tipo_cuentadante' => 'nullable|required_if:es_cuentadante,1|in:planta,contratista',
            'course_id'        => 'nullable|required_if:rol,aprendiz|exists:courses,id',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name'      => $request->name,
                'documento' => $request->documento,
                'email'     => $request->email,
                'celular'   => $request->celular,
                'rol'       => $request->rol,
                'password'  => Hash::make($request->password),
            ]);

            $createdModel = null;

            switch ($request->rol) {
                case 'admin':
                    $createdModel = Admin::create([
                        'user_id'    => $user->id,
                        'tipo_cargo' => $request->tipo_cargo_admin ?? null,
                    ]);
                    break;

                case 'instructor':
                    $tipoCargo = $request->has('es_cuentadante') ? 'cuentadante' : null;
                    $createdModel = Teacher::create([
                        'user_id'          => $user->id,
                        'tipo_cargo'       => $tipoCargo,
                        'tipo_cuentadante' => $tipoCargo === 'cuentadante' ? $request->tipo_cuentadante : null,
                    ]);
                    break;

                case 'aprendiz':
                    $createdModel = Apprentice::create([
                        'user_id'   => $user->id,
                        'course_id' => $request->course_id ?? null,
                        'estado'    => 'en formacion',
                        'etapa'     => 'lectiva',
                    ]);
                    break;
            }

            if ($request->hasFile('imagen') && $createdModel) {
                $file = $request->file('imagen');
                $nombreArchivo = "user_" . time() . "." . $file->guessExtension();
                $file->storeAs('images', $nombreArchivo, 'public');

                $createdModel->images()->create([
                    'imagen' => $nombreArchivo,
                ]);
            }
        });

        return redirect()->route('user.index')
            ->with('success', 'Usuario y perfil creados correctamente.');
    }

    public function edit(User $user)
    {
        $user->load(['admin', 'teacher', 'apprentice.course']);
        $courses = Course::all();
        return view('user.edit', compact('user', 'courses'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'rol'              => 'required|in:admin,instructor,aprendiz',
            'name'             => 'required|string|max:255',
            'documento'        => 'required|string|max:50|unique:users,documento,' . $user->id,
            'email'            => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'celular'          => 'required|string|max:20',
            'password'         => 'nullable|string|min:8|confirmed',
            'imagen'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tipo_cargo_admin' => 'nullable|required_if:rol,admin|in:directivo,subdirectivo,coordinador',
            'es_cuentadante'   => 'nullable|boolean',
            'tipo_cuentadante' => 'nullable|required_if:es_cuentadante,1|in:planta,contratista',
            'course_id'        => 'nullable|required_if:rol,aprendiz|exists:courses,id',
        ]);

        DB::transaction(function () use ($request, $user) {
            $userData = [
                'rol'       => $request->rol,
                'name'      => $request->name,
                'documento' => $request->documento,
                'email'     => $request->email,
                'celular'   => $request->celular,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $user->update($userData);

            $user->admin()->delete();
            $user->teacher()->delete();
            $user->apprentice()->delete();

            $updatedModel = null;

            switch ($request->rol) {
                case 'admin':
                    $updatedModel = Admin::create([
                        'user_id'    => $user->id,
                        'tipo_cargo' => $request->tipo_cargo_admin ?? null,
                    ]);
                    break;

                case 'instructor':
                    $tipoCargo = $request->has('es_cuentadante') ? 'cuentadante' : null;
                    $updatedModel = Teacher::create([
                        'user_id'          => $user->id,
                        'tipo_cargo'       => $tipoCargo,
                        'tipo_cuentadante' => $tipoCargo === 'cuentadante' ? $request->tipo_cuentadante : null,
                    ]);
                    break;

                case 'aprendiz':
                    $updatedModel = Apprentice::create([
                        'user_id'   => $user->id,
                        'course_id' => $request->course_id ?? null,
                        'estado'    => 'en formacion',
                        'etapa'     => 'lectiva',
                    ]);
                    break;
            }

            if ($request->hasFile('imagen') && $updatedModel) {
                $file = $request->file('imagen');
                $nombreArchivo = "user_" . time() . "." . $file->guessExtension();
                $file->storeAs('images', $nombreArchivo, 'public');

                $updatedModel->images()->create([
                    'imagen' => $nombreArchivo,
                ]);
            }
        });

        return redirect()->route('user.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}