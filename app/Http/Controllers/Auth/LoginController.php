<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Apprentice;
use App\Models\Teacher;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Las credenciales ingresadas son incorrectas.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function showRegisterForm()
    {
        $courses = Course::all();
        return view('auth.register', compact('courses'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'rol'       => 'required|in:admin,instructor,aprendiz',
            'name'      => 'required|string|max:255',
            'documento' => 'required|string|max:50|unique:users,documento',
            'email'     => 'required|string|email|max:255|unique:users,email',
            'celular'   => 'required|string|max:20',
            'password'  => 'required|string|min:8|confirmed',
            
            'tipo_cargo_admin' => 'nullable|required_if:rol,admin|in:directivo,subdirectivo,coordinador',
            'es_cuentadante'   => 'nullable|boolean',
            'tipo_cuentadante' => 'nullable|required_if:es_cuentadante,1|in:planta,contratista',
            'course_id'        => 'nullable|required_if:rol,aprendiz|exists:courses,id',
        ]);

        $user = null;

        DB::transaction(function () use ($request, &$user) {
            $user = User::create([
                'name'      => $request->name,
                'documento' => $request->documento,
                'email'     => $request->email,
                'celular'   => $request->celular,
                'rol'       => $request->rol,
                'password'  => Hash::make($request->password),
            ]);

            switch ($request->rol) {
                case 'admin':
                    Admin::create([
                        'user_id'    => $user->id,
                        'tipo_cargo' => $request->tipo_cargo_admin,
                    ]);
                    break;

                case 'instructor':
                    $tipoCargo = $request->has('es_cuentadante') ? 'cuentadante' : null;
                    Teacher::create([
                        'user_id'          => $user->id,
                        'tipo_cargo'       => $tipoCargo,
                        'tipo_cuentadante' => $tipoCargo === 'cuentadante' ? $request->tipo_cuentadante : null,
                    ]);
                    break;

                case 'aprendiz':
                    Apprentice::create([
                        'user_id'   => $user->id,
                        'course_id' => $request->course_id ?? null,
                        'estado'    => 'en formacion',
                        'etapa'     => 'lectiva',
                    ]);
                    break;
            }
        });

        Auth::login($user);

        return redirect()->intended(route('home'))
            ->with('success', '¡Bienvenido! Has registrado tu cuenta correctamente.');
    }
}