@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">

            <div class="card shadow-sm border-0">
                <div class="card-header text-white p-4 shadow-sm"
                    style="background: linear-gradient(135deg, #2ecc71 0%, #00b646 100%); border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-white text-success rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                style="width: 50px; height: 50px;">
                                <i class="bi bi-shield-shaded fs-3"></i>
                            </div>
                            <div>
                                <h3 class="mb-0 fw-bold">Registrar Nuevo Administrador</h3>
                                <p class="mb-0 text-white-50 small">Añade un rol de directivo, subdirectivo o coordinador</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.index') }}" 
                            class="btn btn-outline-light btn-sm fw-bold d-inline-flex align-items-center px-3 py-1 shadow-sm"
                            style="border-width: 2px; border-radius: 1rem;">
                            <i class="bi bi-arrow-left me-1"></i> Volver
                        </a>
                    </div>
                </div>

                <div class="card-body p-4 bg-light">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card border-0 shadow-sm p-3 mb-4">
                            <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                <i class="bi bi-person-badge-fill me-2"></i> Información General
                            </h5>

                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Nombre Completo</label>
                                <input type="text" name="name" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Ej. Ana María Gómez" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="documento" class="form-label fw-semibold">Número de Documento</label>
                                    <input type="text" name="documento" id="documento" class="form-control form-control-lg @error('documento') is-invalid @enderror" value="{{ old('documento') }}" placeholder="Ej. 1098765432" required>
                                    @error('documento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="celular" class="form-label fw-semibold">Celular</label>
                                    <input type="text" name="celular" id="celular" class="form-control form-control-lg @error('celular') is-invalid @enderror" value="{{ old('celular') }}" placeholder="Ej. 3101234567" required>
                                    @error('celular')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm p-3 mb-4">
                            <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                <i class="bi bi-briefcase-fill me-2"></i> Credenciales y Cargo
                            </h5>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Ej. admin@sena.edu.co" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tipo_cargo" class="form-label fw-semibold">Tipo de Cargo</label>
                                    <select name="tipo_cargo" id="tipo_cargo" class="form-select form-select-lg @error('tipo_cargo') is-invalid @enderror" required>
                                        <option value="">Seleccione el tipo de cargo...</option>
                                        <option value="directivo" {{ old('tipo_cargo') == 'directivo' ? 'selected' : '' }}>Directivo</option>
                                        <option value="subdirectivo" {{ old('tipo_cargo') == 'subdirectivo' ? 'selected' : '' }}>Subdirectivo</option>
                                        <option value="coordinador" {{ old('tipo_cargo') == 'coordinador' ? 'selected' : '' }}>Coordinador</option>
                                    </select>
                                    @error('tipo_cargo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Fotografía de Perfil (Ocupa toda la fila) -->
                            <div class="mb-3">
                                <label for="imagen" class="form-label fw-semibold">Fotografía de Perfil</label>
                                <input type="file" name="imagen" id="imagen" class="form-control form-control-lg @error('imagen') is-invalid @enderror" accept="image/*">
                                @error('imagen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label fw-semibold">Contraseña</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label fw-semibold">Confirmar Contraseña</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" required>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                            <a href="{{ route('admin.index') }}" class="btn btn-secondary px-4 fw-semibold" style="border-radius: 0.5rem;">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-success px-4 fw-semibold shadow-sm" style="border-radius: 0.5rem; background-color: #2ecc71; border-color: #2ecc71;">
                                Guardar Administrador
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection