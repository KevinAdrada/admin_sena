@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white p-4 shadow-sm"
                        style="background: linear-gradient(135deg, #2ecc71 0%, #00b646 100%); border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-white text-success rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-pencil-square fs-3"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0 fw-bold">Editar Instructor</h3>
                                    <p class="mb-0 text-white-50 small">Actualizar información del instructor</p>
                                </div>
                            </div>
                            <a href="{{ route('teacher.index') }}"
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

                        <form action="{{ route('teacher.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card border-0 shadow-sm p-3 mb-4">
                                <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                    <i class="bi bi-person-lines-fill me-2"></i> Información Personal y Fotografía
                                </h5>

                                <div class="row align-items-center mb-3">
                                    <div class="col-md-3 text-center mb-3 mb-md-0">
                                        @php
                                            $imageModel = $teacher->images->first();
                                            $avatar = $imageModel
                                                ? asset('storage/images/' . $imageModel->imagen)
                                                : asset('images/default-user.png');
                                        @endphp
                                        <img src="{{ $avatar }}" alt="Foto actual"
                                            class="rounded-circle shadow-sm border mb-2"
                                            style="width: 70px; height: 70px; object-fit: cover;">
                                        <div class="text-muted small">Foto actual</div>

                                        @if ($imageModel)
                                            <div class="form-check form-switch mt-2 d-flex justify-content-center">
                                                <input class="form-check-input text-danger" type="checkbox"
                                                    name="remove_image" id="remove_image" value="1"
                                                    style="cursor: pointer;">
                                                <label class="form-check-label text-danger small ms-2 fw-semibold"
                                                    for="remove_image" style="cursor: pointer;">Eliminar foto</label>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-9">
                                        <label for="imagen" class="form-label fw-semibold">Cambiar Fotografía <span
                                                class="text-muted fw-normal small">(Opcional)</span></label>
                                        <input type="file" name="imagen" id="imagen"
                                            class="form-control @error('imagen') is-invalid @enderror" accept="image/*">
                                        <div class="form-text small text-muted">Si seleccionas una nueva foto, reemplazará a la actual automáticamente.</div>
                                        @error('imagen')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">Nombre Completo</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $teacher->user->name ?? '') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="documento" class="form-label fw-semibold">Número de Documento</label>
                                        <input type="text" name="documento" id="documento"
                                            class="form-control @error('documento') is-invalid @enderror"
                                            value="{{ old('documento', $teacher->user->documento ?? '') }}" required>
                                        @error('documento')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="celular" class="form-label fw-semibold">Celular</label>
                                        <input type="text" name="celular" id="celular"
                                            class="form-control @error('celular') is-invalid @enderror"
                                            value="{{ old('celular', $teacher->user->celular ?? '') }}" required>
                                        @error('celular')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm p-3 mb-4">
                                <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                    <i class="bi bi-shield-lock-fill me-2"></i> Datos de Acceso y Cargo
                                </h5>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $teacher->user->email ?? '') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold">Contraseña <span
                                            class="text-muted fw-normal small">(Opcional)</span></label>
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Dejar en blanco para mantener la actual">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="es_cuentadante" name="es_cuentadante" value="1"
                                            {{ old('es_cuentadante', $teacher->tipo_cargo === 'cuentadante') ? 'checked' : '' }}
                                            style="cursor: pointer; width: 3em; height: 1.5em;">
                                        <label class="form-check-label fw-semibold ms-2 pt-1" for="es_cuentadante" style="cursor: pointer;">
                                            ¿Es Cuentadante?
                                        </label>
                                    </div>
                                    <div class="form-text small text-muted">Marque esta casilla si el instructor maneja cuentas o bienes asignados.</div>
                                </div>

                                <div class="mb-3" id="wrapper_tipo_cuentadante" style="display: none;">
                                    <label for="tipo_cuentadante" class="form-label fw-semibold text-success">Tipo de Cuentadante</label>
                                    <select name="tipo_cuentadante" id="tipo_cuentadante" class="form-select @error('tipo_cuentadante') is-invalid @enderror">
                                        <option value="">Seleccione si es planta o contratista...</option>
                                        <option value="planta" {{ old('tipo_cuentadante', $teacher->tipo_cuentadante) == 'planta' ? 'selected' : '' }}>Planta</option>
                                        <option value="contratista" {{ old('tipo_cuentadante', $teacher->tipo_cuentadante) == 'contratista' ? 'selected' : '' }}>Contratista</option>
                                    </select>
                                    @error('tipo_cuentadante')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                                <a href="{{ route('teacher.index') }}" class="btn btn-secondary px-4 fw-semibold"
                                    style="border-radius: 0.5rem;">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-success px-4 fw-semibold shadow-sm"
                                    style="border-radius: 0.5rem; background-color: #2ecc71; border-color: #2ecc71;">
                                    Actualizar Instructor
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxCuentadante = document.getElementById('es_cuentadante');
            const wrapperCuentadante = document.getElementById('wrapper_tipo_cuentadante');
            const selectCuentadante = document.getElementById('tipo_cuentadante');

            function toggleCuentadante() {
                if (checkboxCuentadante.checked) {
                    wrapperCuentadante.style.display = 'block';
                } else {
                    wrapperCuentadante.style.display = 'none';
                    selectCuentadante.value = '';
                }
            }

            toggleCuentadante();

            checkboxCuentadante.addEventListener('change', toggleCuentadante);
        });
    </script>
    @endpush
@endsection