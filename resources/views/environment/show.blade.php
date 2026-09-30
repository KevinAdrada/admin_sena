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
                                    <i class="bi bi-eye-fill fs-3"></i>
                                </div>
                                <div>
                                    <span class="badge bg-white text-success text-uppercase mb-1 fw-bold small" style="border-radius: 1rem; padding: 0.25rem 0.6rem;">Ficha de Registro</span>
                                    <h3 class="mb-0 fw-bold">{{ $environment->name }}</h3>
                                </div>
                            </div>
                            <a href="{{ url()->previous() }}"
                                class="btn btn-outline-light btn-sm fw-bold d-inline-flex align-items-center px-3 py-1 shadow-sm"
                                style="border-width: 2px; border-radius: 1rem;">
                                <i class="bi bi-arrow-left me-1"></i> Volver
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4 bg-light">
                        @if ($environment->images->count())
                            <div class="card border-0 shadow-sm p-2 mb-4 overflow-hidden rounded">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/images/' . $environment->images->first()->imagen) }}"
                                        alt="Imagen del ambiente" class="img-fluid w-100 rounded object-fit-cover" style="max-height: 320px;">
                                    <span class="position-absolute bottom-0 end-0 m-3 badge bg-dark bg-opacity-75 text-white px-3 py-2">
                                        <i class="bi bi-image me-1">ID: #{{ $environment->id }}</i>
                                    </span>
                                </div>
                            </div>
                        @endif

                        <div class="card border-0 shadow-sm p-4 mb-4">
                            <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                <i class="bi bi-info-circle-fill me-2"></i> Datos del Ambiente
                            </h5>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-1">Centro de Formación</span>
                                        <span class="text-dark fs-6 fw-semibold">{{ $environment->trainingCenter->name ?? 'N/A' }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-1">Ubicación</span>
                                        <span class="text-dark fs-6 fw-semibold">{{ $environment->location ?? 'Sin ubicación' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-muted small px-2">
                            <div class="row text-center text-md-start">
                                <div class="col-md-6 mb-1 mb-md-0">
                                    <i class="bi bi-calendar-plus me-1 text-success"></i>
                                    <strong>Creado el:</strong> {{ \Carbon\Carbon::parse($environment->created_at)->format('d/m/Y H:i') }}
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <i class="bi bi-arrow-clockwise me-1 text-success"></i>
                                    <strong>Última actualización:</strong> {{ \Carbon\Carbon::parse($environment->updated_at)->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection