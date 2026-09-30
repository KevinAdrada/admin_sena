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
                                <i class="bi bi-mortarboard-fill fs-3"></i>
                            </div>
                            <div>
                                <h3 class="mb-0 fw-bold">Registrar Nuevo Aprendiz</h3>
                                <p class="mb-0 text-white-50 small">Añade información personal y académica del aprendiz SENA</p>
                            </div>
                        </div>
                        <a href="{{ route('apprentice.index') }}" 
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

                    <form action="{{ route('apprentice.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card border-0 shadow-sm p-3 mb-4">
                            <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                <i class="bi bi-person-badge-fill me-2"></i> Información Personal / Usuario
                            </h5>
                            
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Nombre Completo</label>
                                <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Ej. Carlos Andrés Pérez" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="documento" class="form-label fw-semibold">Documento de Identidad</label>
                                    <input type="text" class="form-control form-control-lg @error('documento') is-invalid @enderror" id="documento" name="documento" value="{{ old('documento') }}" placeholder="Ej. 1098765432" required>
                                    @error('documento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="celular" class="form-label fw-semibold">Celular</label>
                                    <input type="text" class="form-control form-control-lg @error('celular') is-invalid @enderror" id="celular" name="celular" value="{{ old('celular') }}" placeholder="Ej. 3101234567" required>
                                    @error('celular')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
                                    <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Ej. aprendiz@sena.edu.co" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label fw-semibold">Contraseña</label>
                                    <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm p-3 mb-4">
                            <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                <i class="bi bi-book-fill me-2"></i> Información Académica SENA
                            </h5>

                            <div class="mb-3">
                                <label for="course_id" class="form-label fw-semibold">Curso / Programa</label>
                                <select class="form-select form-select-lg @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                                    <option value="" selected disabled>Seleccione un curso...</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                            {{ $course->course_name ?? $course->nombre ?? 'Curso #' . $course->id }} 
                                            @isset($course->course_number) (Ficha: {{ $course->course_number }}) @endisset
                                        </option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="estado" class="form-label fw-semibold">Estado</label>
                                    <select class="form-select form-select-lg @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                                        <option value="" selected disabled>Seleccione el estado...</option>
                                        <option value="en formacion" {{ old('estado') == 'en formacion' ? 'selected' : '' }}>En formación</option>
                                        <option value="desercion" {{ old('estado') == 'desercion' ? 'selected' : '' }}>Deserción</option>
                                        <option value="retiro voluntario" {{ old('estado') == 'retiro voluntario' ? 'selected' : '' }}>Retiro voluntario</option>
                                    </select>
                                    @error('estado')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3" id="etapa-container" style="display: none;">
                                    <label for="etapa" class="form-label fw-semibold">Etapa</label>
                                    <select class="form-select form-select-lg @error('etapa') is-invalid @enderror" id="etapa" name="etapa">
                                        <option value="" selected disabled>Seleccione la etapa...</option>
                                        <option value="lectiva" {{ old('etapa') == 'lectiva' ? 'selected' : '' }}>Lectiva</option>
                                        <option value="practica" {{ old('etapa') == 'practica' ? 'selected' : '' }}>Práctica</option>
                                    </select>
                                    @error('etapa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="imagen" class="form-label fw-semibold">Fotografía de Perfil</label>
                                <input type="file" class="form-control form-control-lg @error('imagen') is-invalid @enderror" id="imagen" name="imagen" accept="image/*">
                                @error('imagen')
                                    <div class="invalid-feedback">{{ $message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                            <a href="{{ route('apprentice.index') }}" class="btn btn-secondary px-4 fw-semibold" style="border-radius: 0.5rem;">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-success px-4 fw-semibold shadow-sm" style="border-radius: 0.5rem; background-color: #2ecc71; border-color: #2ecc71;">
                                Guardar Aprendiz
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

{{-- Script colocado directamente dentro de content para garantizar su ejecución --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const estadoSelect = document.getElementById('estado');
        const etapaContainer = document.getElementById('etapa-container');
        const etapaSelect = document.getElementById('etapa');

        function toggleEtapa() {
            if (estadoSelect.value === 'en formacion') {
                etapaContainer.style.display = 'block';
                etapaSelect.setAttribute('required', 'required');
            } else {
                etapaContainer.style.display = 'none';
                etapaSelect.removeAttribute('required');
                etapaSelect.value = '';
            }
        }

        // Ejecutar al cargar (por si hay un valor anterior de old() tras un error de validación)
        toggleEtapa();

        // Escuchar cambios en el selector de estado
        estadoSelect.addEventListener('change', toggleEtapa);
    });
</script>
@endsection