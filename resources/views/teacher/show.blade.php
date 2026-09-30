@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <!-- Encabezado con Degradado y Botón Volver -->
                    <div class="card-header text-white p-4 shadow-sm"
                        style="background: linear-gradient(135deg, #2ecc71 0%, #00b646 100%); border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-white text-success rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-person-badge-fill fs-3"></i>
                                </div>
                                <div>
                                    <span class="badge bg-white text-success text-uppercase mb-1 fw-bold small"
                                        style="border-radius: 1rem; padding: 0.25rem 0.6rem;">Ficha de Registro</span>
                                    <h3 class="mb-0 fw-bold">Detalles del Instructor</h3>
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
                        <!-- Perfil / Avatar del Instructor -->
                        <div class="row align-items-center mb-4 text-center">
                            <div class="col-md-12">
                                @php
                                    $imageModel = $teacher->images->first();
                                    $avatar = $imageModel
                                        ? asset('storage/images/' . $imageModel->imagen)
                                        : asset('images/default-user.png');
                                @endphp
                                <img src="{{ $avatar }}" alt="Foto de perfil"
                                    class="rounded-circle shadow-sm border border-3 border-white mb-3 object-fit-cover"
                                    style="width: 110px; height: 110px;">
                                <h4 class="fw-bold text-dark mb-1">{{ $teacher->user->name ?? 'Sin nombre' }}</h4>
                                <span class="text-muted small"><i
                                        class="bi bi-envelope me-1"></i>{{ $teacher->user->email ?? 'Sin correo' }}</span>
                            </div>
                        </div>

                        <!-- Tarjeta de Información General -->
                        <div class="card border-0 shadow-sm p-4 mb-4">
                            <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                <i class="bi bi-info-circle-fill me-2"></i> Información General
                            </h5>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4 h-100">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-1">Documento de
                                            Identidad</span>
                                        <span
                                            class="text-dark fs-6 fw-semibold">{{ $teacher->user->documento ?? 'No registrado' }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4 h-100">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-1">Celular /
                                            Teléfono</span>
                                        <span
                                            class="text-dark fs-6 fw-semibold">{{ $teacher->user->celular ?? 'No registrado' }}</span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="p-3 bg-light rounded border-start border-success border-4">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-2">Tipo de
                                            Cargo</span>
                                        <div>
                                            @if ($teacher->tipo_cargo === 'cuentadante')
                                                <span
                                                    class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 fw-semibold">
                                                    <i class="bi bi-shield-check me-1"></i> Cuentadante
                                                    ({{ ucfirst($teacher->tipo_cuentadante) }})
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-secondary bg-opacity-10 text-secondary border px-3 py-2 fw-semibold">
                                                    <i class="bi bi-person me-1"></i> Instructor Estándar
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 pt-3 border-top">

                            <div><i class="bi bi-calendar-plus me-1 text-success"></i><strong>Creado:</strong>
                                {{ \Carbon\Carbon::parse($teacher->created_at)->format('d/m/Y H:i') }}</div>
                            <div><i class="bi bi-arrow-clockwise me-1 text-success"></i><strong>Actualizado:</strong>
                                {{ \Carbon\Carbon::parse($teacher->updated_at)->format('d/m/Y H:i') }}</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
