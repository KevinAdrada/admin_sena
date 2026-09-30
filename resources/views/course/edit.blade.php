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
                                    <i class="bi bi-journal-check fs-3"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0 fw-bold">Editar Curso</h3>
                                    <p class="mb-0 text-white-50 small">Actualizar la información del curso en el sistema</p>
                                </div>
                            </div>
                            <a href="{{ route('course.index') }}"
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

                        <form action="{{ route('course.update', $course->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card border-0 shadow-sm p-3 mb-4">
                                <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                    <i class="bi bi-info-circle-fill me-2"></i> Información General del Curso
                                </h5>

                                <div class="mb-3">
                                    <label for="course_name" class="form-label fw-semibold">Nombre del Curso</label>
                                    <input type="text" name="course_name" id="course_name"
                                        class="form-control @error('course_name') is-invalid @enderror"
                                        value="{{ old('course_name', $course->course_name) }}" placeholder="Ej. Análisis y Desarrollo de Software" required>
                                    @error('course_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="course_number" class="form-label fw-semibold">Número del Curso (Ficha)</label>
                                    <input type="text" name="course_number" id="course_number"
                                        class="form-control @error('course_number') is-invalid @enderror"
                                        value="{{ old('course_number', $course->course_number) }}" placeholder="Ej. 2827481" required>
                                    @error('course_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="program_type" class="form-label fw-semibold">Tipo de Programa</label>
                                    <select name="program_type" id="program_type"
                                        class="form-select @error('program_type') is-invalid @enderror" required>
                                        <option value="">Seleccione...</option>
                                        <option value="tecnico" {{ old('program_type', $course->program_type) == 'tecnico' ? 'selected' : '' }}>Técnico</option>
                                        <option value="tecnologo" {{ old('program_type', $course->program_type) == 'tecnologo' ? 'selected' : '' }}>Tecnólogo</option>
                                    </select>
                                    @error('program_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="start_date" class="form-label fw-semibold">Fecha de Inicio</label>
                                        <input type="date" name="start_date" id="start_date"
                                            class="form-control @error('start_date') is-invalid @enderror"
                                            value="{{ old('start_date', $course->start_date) }}" required>
                                        @error('start_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="end_date" class="form-label fw-semibold">Fecha de Fin</label>
                                        <input type="date" name="end_date" id="end_date"
                                            class="form-control @error('end_date') is-invalid @enderror"
                                            value="{{ old('end_date', $course->end_date) }}" required>
                                        @error('end_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm p-3 mb-4">
                                <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                    <i class="bi bi-geo-alt-fill me-2"></i> Ubicación y Áreas
                                </h5>

                                <div class="mb-3">
                                    <label for="environment_id" class="form-label fw-semibold">Ambiente</label>
                                    <select name="environment_id" id="environment_id"
                                        class="form-select @error('environment_id') is-invalid @enderror" required>
                                        <option value="">Seleccione un ambiente</option>
                                        @foreach ($environments as $env)
                                            <option value="{{ $env->id }}"
                                                {{ old('environment_id', $course->environment_id) == $env->id ? 'selected' : '' }}>
                                                {{ $env->name }} - {{ $env->location }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('environment_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold d-block">Áreas asociadas</label>
                                    <div class="border p-3 rounded bg-white shadow-sm">
                                        <div class="row">
                                            @foreach ($areas as $area)
                                                <div class="col-md-4 mb-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" 
                                                            type="checkbox" 
                                                            name="areas[]" 
                                                            value="{{ $area->id }}" 
                                                            id="area_{{ $area->id }}"
                                                            {{ (is_array(old('areas')) && in_array($area->id, old('areas'))) || (!old('areas') && $course->areas->contains($area->id)) ? 'checked' : '' }}>
                                                        
                                                        <label class="form-check-label user-select-none" for="area_{{ $area->id }}">
                                                            {{ $area->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <small class="text-muted">Selecciona una o varias casillas según corresponda.</small>
                                    @error('areas')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                                <a href="{{ route('course.index') }}" class="btn btn-secondary px-4 fw-semibold"
                                    style="border-radius: 0.5rem;">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-success px-4 fw-semibold shadow-sm"
                                    style="border-radius: 0.5rem; background-color: #2ecc71; border-color: #2ecc71;">
                                    Actualizar Curso
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection