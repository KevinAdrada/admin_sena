@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="card shadow-sm border-0">
            <div class="card-header text-white p-4 shadow-sm"
                style="background: linear-gradient(135deg, #2ecc71 0%, #00b646 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="mb-0 fw-bold">Lista de Aprendices</h3>
                        <p class="mb-0 text-white-50 small">Gestión y control de aprendices registrados</p>
                    </div>
                    <a href="{{ route('apprentice.create') }}"
                        class="btn btn-outline-light btn-sm fw-bold d-inline-flex align-items-center px-3 py-1 shadow-sm"
                        style="border-width: 2px; border-radius: 1rem;">
                        <i class="bi bi-plus-circle me-1"></i> Registrar Nuevo Aprendiz
                    </a>
                </div>
            </div>

            <div class="card-body p-4 bg-light">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive bg-white rounded-3 shadow-sm p-3">
                    <table class="table table-hover align-middle mb-0" style="width:100%">
                        <thead class="table-light text-center">
                            <tr>
                                <th style="width: 80px;">Imagen</th>
                                <th class="text-start">Nombre</th>
                                <th class="text-start">Documento</th>
                                <th class="text-center">Celular</th>
                                <th class="text-start">Curso / Ficha</th>
                                <th>Estado</th>
                                <th>Etapa</th>
                                <th class="text-center" style="width: 197px; min-width: 197px; max-width: 197px;">Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($apprentices as $apprentice)
                                <tr class="text-center">
                                    <td>
                                        @php
                                            $imageModel = $apprentice->images->first();
                                            $avatar = $imageModel
                                                ? asset('storage/images/' . $imageModel->imagen)
                                                : asset('images/default-user.png');
                                        @endphp
                                        <img src="{{ $avatar }}" alt="Foto de {{ optional($apprentice->user)->name }}"
                                            class="rounded-circle shadow-sm"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                    </td>
                                    <td class="fw-semibold text-start">{{ $apprentice->user->name ?? 'N/A' }}</td>
                                    <td class="text-start">{{ $apprentice->user->documento ?? 'N/A' }}</td>
                                    <td class="text-center">{{ $apprentice->user->celular ?? 'N/A' }}</td>
                                    <td class="text-start">
                                        {{ $apprentice->course->course_name ?? 'Sin curso' }}
                                        @if ($apprentice->course && isset($apprentice->course->course_number))
                                            <span class="text-muted small">({{ $apprentice->course->course_number }})</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $apprentice->estado === 'en formacion' ? 'success' : ($apprentice->estado === 'retiro voluntario' ? 'warning text-dark' : 'danger') }}">
                                            {{ ucfirst($apprentice->estado) }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $apprentice->etapa ? ucfirst($apprentice->etapa) : '-' }}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <a href="{{ route('apprentice.show', $apprentice->id) }}"
                                                class="btn btn-outline-success btn-icon" title="Ver">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('apprentice.edit', $apprentice->id) }}"
                                                class="btn btn-outline-primary btn-icon" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('apprentice.destroy', $apprentice->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('¿Estás seguro de eliminar este aprendiz?');"
                                                class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-icon"
                                                    title="Eliminar">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="bi bi-folder-x fs-2 d-block mb-2"></i>
                                        No hay aprendices registrados actualmente.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .btn-icon {
            width: 36px;
            height: 36px;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 0.5rem;
            padding: 0 !important;
            line-height: 1 !important;
        }

        .btn-icon i {
            font-size: 16px !important;
            line-height: 1 !important;
            margin: 0 !important;
        }
    </style>
@endsection
