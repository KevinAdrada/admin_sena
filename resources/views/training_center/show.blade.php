@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card shadow-sm border-0">
                    <!-- Encabezado con Degradado y Botón Volver -->
                    <div class="card-header text-white p-4 shadow-sm"
                        style="background: linear-gradient(135deg, #2ecc71 0%, #00b646 100%); border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-white text-success rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-building fs-3"></i>
                                </div>
                                <div>
                                    <span class="badge bg-white text-success text-uppercase mb-1 fw-bold small" style="border-radius: 1rem; padding: 0.25rem 0.6rem;">Ficha de Registro</span>
                                    <h3 class="mb-0 fw-bold">{{ $training_center['name'] }}</h3>
                                </div>
                            </div>
                            <a href="{{ route('training_center.index') }}"
                                class="btn btn-outline-light btn-sm fw-bold d-inline-flex align-items-center px-3 py-1 shadow-sm"
                                style="border-width: 2px; border-radius: 1rem;">
                                <i class="bi bi-arrow-left me-1"></i> Volver
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4 bg-light">
                        <!-- Imagen destacada del centro si existe -->
                        @if ($training_center->images->count())
                            <div class="card border-0 shadow-sm p-2 mb-4 overflow-hidden rounded">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/images/' . $training_center->images->first()->imagen) }}"
                                        alt="Imagen del centro" class="img-fluid w-100 rounded object-fit-cover" style="max-height: 320px;">
                                    <span class="position-absolute bottom-0 end-0 m-3 badge bg-dark bg-opacity-75 text-white px-3 py-2">
                                        <i class="bi bi-image me-1">ID: #{{ $training_center['id'] }}</i>
                                    </span>
                                </div>
                            </div>
                        @endif

                        <!-- Tarjeta de Información General -->
                        <div class="card border-0 shadow-sm p-4 mb-4">
                            <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                <i class="bi bi-info-circle-fill me-2"></i> Datos del Centro de Formación
                            </h5>

                            <div class="p-3 bg-light rounded border-start border-success border-4">
                                <span class="text-muted d-block text-uppercase fw-bold small mb-1">Ubicación</span>
                                <span class="text-dark fs-6 fw-semibold">{{ $training_center['location'] ?? 'Sin ubicación' }}</span>
                            </div>
                        </div>

                        <!-- Tarjeta de Ambientes Asociados -->
                        <div class="card border-0 shadow-sm p-4 mb-4">
                            <h5 class="text-success fw-bold mb-3 border-bottom pb-2 d-flex align-items-center justify-content-between">
                                <span><i class="bi bi-door-open-fill me-2"></i> Ambientes Asociados</span>
                                <span class="badge bg-success rounded-pill px-3 py-2 fs-6">{{ $training_center->environments?->count() ?? 0 }}</span>
                            </h5>

                            @if ($training_center->environments && $training_center->environments->count() > 0)
                                <div class="row g-3">
                                    @foreach ($training_center->environments as $environment)
                                        <div class="col-md-4 col-sm-6 text-center">
                                            <a href="{{ route('environment.show', $environment->id) }}"
                                                class="text-decoration-none card border-0 h-100 p-3 bg-white rounded-3 shadow-sm transition-hover">
                                                <div class="mx-auto mb-2" style="width: 75px; height: 75px;">
                                                    @if (isset($environment->images) && $environment->images->count())
                                                        <img src="{{ asset('storage/images/' . $environment->images->first()->imagen) }}"
                                                            alt="{{ $environment->name }}"
                                                            class="w-100 h-100 rounded-circle shadow-sm border object-fit-cover">
                                                    @else
                                                        <div class="w-100 h-100 rounded-circle bg-success text-white d-flex align-items-center justify-content-center shadow-sm">
                                                            <i class="bi bi-pc-display fs-4"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <h6 class="fw-bold text-dark mb-0 text-truncate small" title="{{ $environment->name }}">
                                                    {{ $environment->name }}
                                                </h6>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2 text-black-50"></i>
                                    <p class="mb-0">No hay ambientes asociados a este centro de formación.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Pie de tarjeta con fechas de auditoría -->
                        <div class="text-muted small px-2">
                            <div class="row text-center text-md-start">
                                <div class="col-md-6 mb-1 mb-md-0">
                                    <i class="bi bi-calendar-plus me-1 text-success"></i>
                                    <strong>Creado el:</strong> {{ \Carbon\Carbon::parse($training_center['created_at'])->format('d/m/Y H:i') }}
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <i class="bi bi-arrow-clockwise me-1 text-success"></i>
                                    <strong>Última actualización:</strong> {{ \Carbon\Carbon::parse($training_center['updated_at'])->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection