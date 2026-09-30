@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 30px; margin-bottom: 50px;">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white p-4 shadow-sm"
                        style="background: linear-gradient(135deg, #2ecc71 0%, #00b646 100%); border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-white text-success rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-person-plus-fill fs-3"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0 fw-bold">Crear Usuario</h3>
                                    <p class="mb-0 text-white-50 small">Registra un nuevo usuario en el sistema</p>
                                </div>
                            </div>
                            <a href="{{ route('user.index') }}"
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
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card border-0 shadow-sm p-3 mb-4">
                                <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                    <i class="bi bi-shield-lock-fill me-2"></i> Tipo de Cuenta
                                </h5>

                                <div class="mb-3">
                                    <label for="rol" class="form-label fw-semibold">Rol</label>
                                    <select name="rol" id="rol" class="form-select form-select-lg @error('rol') is-invalid @enderror" required>
                                        <option value="">Seleccione un rol</option>
                                        <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="instructor" {{ old('rol') == 'instructor' ? 'selected' : '' }}>Instructor</option>
                                        <option value="aprendiz" {{ old('rol') == 'aprendiz' ? 'selected' : '' }}>Aprendiz</option>
                                    </select>
                                    @error('rol')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div id="fields-admin" class="role-fields mb-4" style="display: none;">
                                <div class="card border-0 shadow-sm p-3">
                                    <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                        <i class="bi bi-briefcase me-2"></i> Detalles de Administrador
                                    </h5>
                                    <div class="mb-3">
                                        <label for="tipo_cargo_admin" class="form-label fw-semibold">Tipo de Cargo</label>
                                        <select name="tipo_cargo_admin" id="tipo_cargo_admin" class="form-select form-select-lg @error('tipo_cargo_admin') is-invalid @enderror">
                                            <option value="">Seleccione tipo de cargo</option>
                                            <option value="directivo" {{ old('tipo_cargo_admin') == 'directivo' ? 'selected' : '' }}>Directivo</option>
                                            <option value="subdirectivo" {{ old('tipo_cargo_admin') == 'subdirectivo' ? 'selected' : '' }}>Subdirectivo</option>
                                            <option value="coordinador" {{ old('tipo_cargo_admin') == 'coordinador' ? 'selected' : '' }}>Coordinador</option>
                                        </select>
                                        @error('tipo_cargo_admin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div id="fields-instructor" class="role-fields mb-4" style="display: none;">
                                <div class="card border-0 shadow-sm p-3">
                                    <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                        <i class="bi bi-shield-check me-2"></i> Detalles de Instructor
                                    </h5>
                                    <div class="form-check form-switch mb-3 ms-1">
                                        <input class="form-check-input" type="checkbox" id="es_cuentadante" name="es_cuentadante" value="1" {{ old('es_cuentadante') ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold text-secondary" for="es_cuentadante">¿Es Cuentadante?</label>
                                    </div>
                                    <div class="mb-3" id="wrapper-tipo-cuentadante" style="display: none;">
                                        <label for="tipo_cuentadante" class="form-label fw-semibold">Tipo de Cuentadante</label>
                                        <select name="tipo_cuentadante" id="tipo_cuentadante" class="form-select form-select-lg @error('tipo_cuentadante') is-invalid @enderror">
                                            <option value="">Seleccione tipo de cuentadante</option>
                                            <option value="planta" {{ old('tipo_cuentadante') == 'planta' ? 'selected' : '' }}>Planta</option>
                                            <option value="contratista" {{ old('tipo_cuentadante') == 'contratista' ? 'selected' : '' }}>Contratista</option>
                                        </select>
                                        @error('tipo_cuentadante')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div id="fields-aprendiz" class="role-fields mb-4" style="display: none;">
                                <div class="card border-0 shadow-sm p-3">
                                    <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                        <i class="bi bi-journal-bookmark me-2"></i> Detalles de Aprendiz
                                    </h5>
                                    <div class="mb-3">
                                        <label for="course_id" class="form-label fw-semibold">Curso</label>
                                        <select name="course_id" id="course_id" class="form-select form-select-lg @error('course_id') is-invalid @enderror">
                                            <option value="">Seleccione un curso</option>
                                            @if(isset($courses))
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                                        {{ $course->course_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('course_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm p-3 mb-4">
                                <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                    <i class="bi bi-person-fill me-2"></i> Información Personal
                                </h5>

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">Nombre</label>
                                    <input type="text" name="name" id="name" 
                                           class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Ej. Juan Pérez" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="documento" class="form-label fw-semibold">Documento</label>
                                    <input type="text" name="documento" id="documento" 
                                           class="form-control form-control-lg @error('documento') is-invalid @enderror" value="{{ old('documento') }}" placeholder="Ej. 1023456789" required>
                                    @error('documento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Correo electrónico</label>
                                    <input type="email" name="email" id="email" 
                                           class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Ej. correo@sena.edu.co" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="celular" class="form-label fw-semibold">Celular</label>
                                    <input type="text" name="celular" id="celular" 
                                           class="form-control form-control-lg @error('celular') is-invalid @enderror" value="{{ old('celular') }}" placeholder="Ej. 3001234567" required>
                                    @error('celular')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="imagen" class="form-label fw-semibold">Imagen de perfil</label>
                                    <input type="file" name="imagen" id="imagen" class="form-control form-control-lg @error('imagen') is-invalid @enderror" accept="image/*">
                                    @error('imagen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm p-3 mb-4">
                                <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                    <i class="bi bi-key-fill me-2"></i> Seguridad
                                </h5>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold">Contraseña</label>
                                    <input type="password" name="password" id="password" 
                                           class="form-control form-control-lg @error('password') is-invalid @enderror" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label fw-semibold">Confirmar Contraseña</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" 
                                           class="form-control form-control-lg" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                                <a href="{{ route('user.index') }}" class="btn btn-secondary px-4 fw-semibold"
                                    style="border-radius: 0.5rem;">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-success px-4 fw-semibold shadow-sm"
                                    style="border-radius: 0.5rem; background-color: #2ecc71; border-color: #2ecc71;">
                                    Guardar Usuario
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const rolSelect = document.getElementById('rol');
            const fieldsAdmin = document.getElementById('fields-admin');
            const fieldsInstructor = document.getElementById('fields-instructor');
            const fieldsAprendiz = document.getElementById('fields-aprendiz');
            
            const checkboxCuentadante = document.getElementById('es_cuentadante');
            const wrapperTipoCuentadante = document.getElementById('wrapper-tipo-cuentadante');

            function toggleRoleFields() {
                const selectedRol = rolSelect.value;

                fieldsAdmin.style.display = 'none';
                fieldsInstructor.style.display = 'none';
                fieldsAprendiz.style.display = 'none';

                if (selectedRol === 'admin') {
                    fieldsAdmin.style.display = 'block';
                } else if (selectedRol === 'instructor') {
                    fieldsInstructor.style.display = 'block';
                } else if (selectedRol === 'aprendiz') {
                    fieldsAprendiz.style.display = 'block';
                }
            }

            function toggleCuentadanteField() {
                if (checkboxCuentadante && checkboxCuentadante.checked) {
                    wrapperTipoCuentadante.style.display = 'block';
                } else {
                    wrapperTipoCuentadante.style.display = 'none';
                    const selectTipo = document.getElementById('tipo_cuentadante');
                    if (selectTipo) selectTipo.value = '';
                }
            }

            rolSelect.addEventListener('change', toggleRoleFields);
            if (checkboxCuentadante) {
                checkboxCuentadante.addEventListener('change', toggleCuentadanteField);
            }

            toggleRoleFields();
            toggleCuentadanteField();
        });
    </script>
@endsection