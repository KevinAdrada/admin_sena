<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::with(['user', 'images'])->get();
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'documento'  => 'required|string|unique:users,documento',
            'email'      => 'required|email|unique:users,email',
            'celular'    => 'required|string|max:20',
            'password'   => 'required|string|min:6',
            'imagen'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tipo_cargo' => 'required|in:directivo,subdirectivo,coordinador',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name'      => $request->name,
                'documento' => $request->documento,
                'email'     => $request->email,
                'celular'   => $request->celular,
                'rol'       => 'admin',
                'password'  => Hash::make($request->password),
            ]);

            $admin = Admin::create([
                'user_id'    => $user->id,
                'tipo_cargo' => $request->tipo_cargo,
            ]);

            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $nombreArchivo = "admin_" . time() . "." . $file->guessExtension();
                $file->storeAs('images', $nombreArchivo, 'public');

                $admin->images()->create([
                    'imagen' => $nombreArchivo,
                ]);
            }
        });

        return redirect()->route('admin.index')->with('success', 'Administrador creado correctamente.');
    }

    public function show(Admin $admin)
    {
        $admin->load(['user', 'images']);
        return view('admin.show', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        $admin->load(['user', 'images']);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'documento'  => 'required|string|unique:users,documento,' . $admin->user_id,
            'email'      => 'required|email|unique:users,email,' . $admin->user_id,
            'celular'    => 'required|string|max:20',
            'tipo_cargo' => 'required|in:directivo,subdirectivo,coordinador',
            'imagen'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password'   => 'nullable|string|min:6',
        ]);

        DB::transaction(function () use ($request, $admin) {
            $userData = [
                'name'      => $request->name,
                'documento' => $request->documento,
                'email'     => $request->email,
                'celular'   => $request->celular,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $admin->user->update($userData);

            $admin->update([
                'tipo_cargo' => $request->tipo_cargo,
            ]);

            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $nombreArchivo = "admin_" . time() . "." . $file->guessExtension();
                $file->storeAs('images', $nombreArchivo, 'public');
                foreach ($admin->images as $oldImage) {
                    Storage::disk('public')->delete('images/' . $oldImage->imagen);
                    $oldImage->delete();
                }
                $admin->images()->create([
                    'imagen' => $nombreArchivo,
                ]);
            }
            if ($request->has('remove_image')) {
                $imageModel = $admin->images->first();
                if ($imageModel) {
                    Storage::disk('public')->delete('images/' . $imageModel->imagen);
                    $imageModel->delete();
                }
            }
        });

        return redirect()->route('admin.index')->with('success', 'Administrador actualizado correctamente.');
    }

    public function destroy(Admin $admin)
    {
        DB::transaction(function () use ($admin) {
            foreach ($admin->images as $image) {
                Storage::disk('public')->delete('images/' . $image->imagen);
                $image->delete();
            }

            $user = $admin->user;
            $admin->delete();

            if ($user) {
                $user->delete();
            }
        });

        return redirect()->route('admin.index')->with('success', 'Administrador eliminado correctamente.');
    }
}
