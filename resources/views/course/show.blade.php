@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white p-4 shadow-sm"
                        style="background: linear-gradient(135deg, #2ecc71 0%, #00b646 100%); border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-white text-success rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-book-half fs-3"></i>
                                </div>
                                <div>
                                    <span class="badge bg-white text-success text-uppercase mb-1 fw-bold small" style="border-radius: 1rem; padding: 0.25rem 0.6rem;">Ficha de Registro</span>
                                    <h3 class="mb-0 fw-bold">Detalles del Curso</h3>
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
                        <div class="card border-0 shadow-sm p-4 mb-4">
                            <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                <i class="bi bi-info-circle-fill me-2"></i> Información General del Curso
                            </h5>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4 h-100">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-1">Nombre del Curso</span>
                                        <span class="text-dark fs-6 fw-semibold">{{ $course->course_name }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4 h-100">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-1">Número del Curso</span>
                                        <span class="text-dark fs-6 fw-semibold">{{ $course->course_number }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4 h-100">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-2">Tipo de Programa</span>
                                        <div>
                                            <span class="badge bg-{{ $course->program_type == 'tecnologo' ? 'primary' : 'info' }} bg-opacity-10 text-{{ $course->program_type == 'tecnologo' ? 'primary' : 'dark' }} border border-{{ $course->program_type == 'tecnologo' ? 'primary' : 'info' }} text-uppercase px-3 py-2 fw-semibold">
                                                <i class="bi bi-mortarboard me-1"></i> {{ $course->program_type }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4 h-100">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-2">Ambiente Asignado</span>
                                        <div>
                                            @if($course->environment)
                                                <span class="text-dark fw-semibold fs-6">
                                                    <i class="bi bi-door-open me-1 text-success"></i> {{ $course->environment->name }} 
                                                    <span class="text-muted small">({{ $course->environment->location }})</span>
                                                </span>
                                            @else
                                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2 fw-semibold">
                                                    <i class="bi bi-exclamation-circle me-1"></i> Sin ambiente asignado
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4 h-100">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-1">Fecha de Inicio</span>
                                        <span class="text-dark fs-6 fw-semibold"><i class="bi bi-calendar-event me-1 text-success"></i> {{ $course->start_date }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4 h-100">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-1">Fecha de Fin</span>
                                        <span class="text-dark fs-6 fw-semibold"><i class="bi bi-calendar-check me-1 text-success"></i> {{ $course->end_date }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm p-4 mb-4">
                            <h5 class="text-success fw-bold mb-3 border-bottom pb-2 d-flex align-items-center justify-content-between">
                                <span><i class="bi bi-diagram-3-fill me-2"></i> Áreas Asociadas</span>
                                <span class="badge bg-success rounded-pill px-3 py-2 fs-6">{{ $course->areas?->count() ?? 0 }}</span>
                            </h5>

                            <div class="p-3 bg-light rounded border-start border-success border-4">
                                @forelse($course->areas as $area)
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success me-1 mb-2 px-3 py-2 fw-semibold fs-6">
                                        <i class="bi bi-check2 me-1"></i> {{ $area->name }}
                                    </span>
                                @empty
                                    <div class="text-center py-3 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-1 text-black-50"></i>
                                        <span class="fst-italic">Este curso no tiene áreas asociadas.</span>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 pt-3 border-top">
                            
                                <div><i class="bi bi-calendar-plus me-1 text-success"></i><strong>Creado:</strong> {{ isset($course->created_at) ? \Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i') : 'N/A' }}</div>
                                <div><i class="bi bi-arrow-clockwise me-1 text-success"></i><strong>Actualizado:</strong> {{ isset($course->updated_at) ? \Carbon\Carbon::parse($course->updated_at)->format('d/m/Y H:i') : 'N/A' }}</div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection