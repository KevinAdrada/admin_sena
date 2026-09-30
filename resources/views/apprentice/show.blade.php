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
                                    <i class="bi bi-person-lines-fill fs-3"></i>
                                </div>
                                <div>
                                    <span class="badge bg-white text-success text-uppercase mb-1 fw-bold small"
                                        style="border-radius: 1rem; padding: 0.25rem 0.6rem;">Ficha de Registro</span>
                                    <h3 class="mb-0 fw-bold">Detalles del Aprendiz</h3>
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

                        @php
                            $nombre = optional($apprentice->user)->name ?? ($apprentice->name ?? 'Sin Nombre');
                            $email = optional($apprentice->user)->email ?? ($apprentice->email ?? 'No registrado');
                            $estado = $apprentice->estado ?? 'en formacion';

                            $imageModel = $apprentice->images->first();
                            $imagenPath = $imageModel->imagen ?? ($apprentice->imagen ?? null);
                        @endphp

                        <div class="row align-items-center mb-4 text-center">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    @if (!empty($imagenPath))
                                        <img src="{{ asset('storage/images/' . $imagenPath) }}"
                                            alt="Foto de {{ $nombre }}"
                                            class="rounded-circle shadow-sm border border-3 border-white object-fit-cover mx-auto"
                                            width="110" height="110">
                                    @else
                                        <img src="{{ asset('images/default-user.png') }}" alt="Foto por defecto"
                                            class="rounded-circle shadow-sm border border-3 border-white object-fit-cover mx-auto"
                                            width="110" height="110">
                                    @endif
                                </div>
                                <h4 class="fw-bold text-dark mb-1">{{ $nombre }}</h4>
                                <span class="text-muted small d-block mb-3"><i class="bi bi-envelope me-1"></i>
                                    {{ $email }}</span>

                                <div>
                                    @php
                                        $estadoColor = match ($estado) {
                                            'en formacion'
                                                => 'bg-success bg-opacity-10 text-success border border-success',
                                            'retiro voluntario'
                                                => 'bg-warning bg-opacity-10 text-dark border border-warning',
                                            default => 'bg-danger bg-opacity-10 text-danger border border-danger',
                                        };
                                    @endphp
                                    <span class="badge {{ $estadoColor }} px-3 py-2 fw-semibold text-uppercase">
                                        <i class="bi bi-circle-fill me-1 small"></i>
                                        {{ ucfirst(str_replace('_', ' ', $estado)) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm p-4 mb-4">
                            <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                <i class="bi bi-person-badge-fill me-2"></i> Información Personal
                            </h5>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4 h-100">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-1">Documento de
                                            Identidad</span>
                                        <span
                                            class="text-dark fs-6 fw-semibold">{{ $apprentice->user->documento ?? 'No registrado' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4 h-100">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-1">Celular /
                                            Teléfono</span>
                                        <span
                                            class="text-dark fs-6 fw-semibold">{{ $apprentice->user->celular ?? 'No registrado' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta de Información Académica SENA -->
                        <div class="card border-0 shadow-sm p-4 mb-4">
                            <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                <i class="bi bi-book-fill me-2"></i> Información Académica SENA
                            </h5>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4 h-100">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-1">Programa /
                                            Curso</span>
                                        <span class="text-dark fs-6 fw-semibold">
                                            {{ optional($apprentice->course)->course_name ?? (optional($apprentice->course)->nombre ?? 'Curso no asignado') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4 h-100">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-1">Ficha</span>
                                        <span class="text-dark fs-6 fw-semibold">
                                            {{ optional($apprentice->course)->course_number ?? (optional($apprentice->course)->ficha ?? 'No especificada') }}
                                        </span>
                                    </div>
                                </div>

                                @if ($estado === 'en formacion' && !empty($apprentice->etapa))
                                    <div class="col-md-12">
                                        <div class="p-3 bg-light rounded border-start border-success border-4">
                                            <span class="text-muted d-block text-uppercase fw-bold small mb-1">Etapa
                                                Actual</span>
                                            <span class="text-success fs-6 fw-bold text-uppercase">
                                                {{ $apprentice->etapa }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 pt-3 border-top">

                            <div><i class="bi bi-calendar-plus me-1 text-success"></i><strong>Creado:</strong>
                                {{ isset($apprentice->created_at) ? \Carbon\Carbon::parse($apprentice->created_at)->format('d/m/Y H:i') : 'N/A' }}
                            </div>
                            <div><i class="bi bi-arrow-clockwise me-1 text-success"></i><strong>Actualizado:</strong>
                                {{ isset($apprentice->updated_at) ? \Carbon\Carbon::parse($apprentice->updated_at)->format('d/m/Y H:i') : 'N/A' }}
                            </div>


                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
