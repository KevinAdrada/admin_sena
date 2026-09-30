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
                                    <i class="bi bi-person-badge fs-3"></i>
                                </div>
                                <div>
                                    <span class="badge bg-white text-success text-uppercase mb-1 fw-bold small"
                                        style="border-radius: 1rem; padding: 0.25rem 0.6rem;">Ficha de Registro</span>
                                    <h3 class="mb-0 fw-bold">Detalles del Administrador</h3>
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
                        <div class="row align-items-center mb-4 text-center">
                            <div class="col-md-12">
                                @php
                                    $imageModel = $admin->images->first();
                                    $avatar = $imageModel
                                        ? asset('storage/images/' . $imageModel->imagen)
                                        : asset('images/default-user.png');
                                @endphp
                                <img src="{{ $avatar }}" alt="Foto de perfil"
                                    class="rounded-circle shadow-sm border border-3 border-white mb-3 object-fit-cover"
                                    style="width: 110px; height: 110px;">
                                <h4 class="fw-bold text-dark mb-1">{{ $admin->user->name ?? 'Sin nombre' }}</h4>
                                <span class="text-muted small"><i
                                        class="bi bi-envelope me-1"></i>{{ $admin->user->email ?? 'Sin correo' }}</span>
                            </div>
                        </div>

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
                                            class="text-dark fs-6 fw-semibold">{{ $admin->user->documento ?? 'No registrado' }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4 h-100">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-1">Celular /
                                            Teléfono</span>
                                        <span
                                            class="text-dark fs-6 fw-semibold">{{ $admin->user->celular ?? 'No registrado' }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4 h-100">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-2">Rol en el
                                            Sistema</span>
                                        <div>
                                            <span
                                                class="badge bg-secondary bg-opacity-10 text-secondary border px-3 py-2 fw-semibold text-uppercase">
                                                <i class="bi bi-person-gear me-1"></i> {{ $admin->user->rol ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4 h-100">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-2">Tipo de
                                            Cargo</span>
                                        <div>
                                            @php
                                                $badgeColor = match ($admin->tipo_cargo) {
                                                    'directivo'
                                                        => 'bg-danger bg-opacity-10 text-danger border border-danger',
                                                    'subdirectivo'
                                                        => 'bg-warning bg-opacity-10 text-dark border border-warning',
                                                    'coordinador'
                                                        => 'bg-primary bg-opacity-10 text-primary border border-primary',
                                                    default => 'bg-info bg-opacity-10 text-dark border border-info',
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeColor }} px-3 py-2 fw-semibold text-uppercase">
                                                <i class="bi bi-shield-check me-1"></i> {{ $admin->tipo_cargo }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 pt-3 border-top">

                            <div><i class="bi bi-calendar-plus me-1 text-success"></i><strong>Creado:</strong>
                                {{ isset($admin->created_at) ? \Carbon\Carbon::parse($admin->created_at)->format('d/m/Y H:i') : 'N/A' }}
                            </div>
                            <div><i class="bi bi-arrow-clockwise me-1 text-success"></i><strong>Actualizado:</strong>
                                {{ isset($admin->updated_at) ? \Carbon\Carbon::parse($admin->updated_at)->format('d/m/Y H:i') : 'N/A' }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
