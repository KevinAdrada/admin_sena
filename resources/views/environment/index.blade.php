@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="card shadow-sm border-0">
            <div class="card-header text-white p-4 shadow-sm"
                 style="background: linear-gradient(135deg, #2ecc71 0%, #00b646 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="mb-0 fw-bold">Ambientes</h3>
                        <p class="mb-0 text-white-50 small">Gestión y control de ambientes de formación</p>
                    </div>
                    <a href="{{ route('environment.create') }}"
                        class="btn btn-outline-light btn-sm fw-bold d-inline-flex align-items-center px-3 py-1 shadow-sm"
                        style="border-width: 2px; border-radius: 1rem;">
                        <i class="bi bi-plus-circle me-1"></i> Nuevo Ambiente
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
                                <th>ID</th>
                                <th style="width: 80px;">Imagen</th>
                                <th class="text-start">Nombre</th>
                                <th class="text-start">Ubicación</th>
                                <th class="text-start">Centro de Formación</th>
                                <th>Registro</th>
                                <th class="text-center" style="width: 197px; min-width: 197px; max-width: 197px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($environments as $environment)
                                <tr class="text-center">
                                    <td>{{ $environment->id }}</td>
                                    <td>
                                        @php
                                            $imageModel = $environment->images->first();
                                            $avatar = $imageModel
                                                ? asset('storage/images/' . $imageModel->imagen)
                                                : asset('images/default-user.png');
                                        @endphp
                                        <img src="{{ $avatar }}" alt="Foto de {{ $environment->name }}"
                                             class="rounded-circle shadow-sm"
                                             style="width: 40px; height: 40px; object-fit: cover;">
                                    </td>
                                    <td class="fw-semibold text-start">{{ $environment->name }}</td>
                                    <td class="text-start">{{ $environment->location ?? 'Sin ubicación' }}</td>
                                    <td class="text-start">{{ $environment->trainingCenter->name ?? 'N/A' }}</td>
                                    <td>{{ $environment->created_at ? $environment->created_at->format('d/m/Y') : 'N/A' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <a href="{{ route('environment.show', $environment->id) }}"
                                                class="btn btn-outline-success btn-icon" title="Ver">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('environment.edit', $environment->id) }}"
                                                class="btn btn-outline-primary btn-icon" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('environment.destroy', $environment->id) }}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de que deseas eliminar este ambiente?');"
                                                class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-icon" title="Eliminar">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <i class="bi bi-folder-x fs-2 d-block mb-2"></i>
                                        No hay ambientes registrados todavía.
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
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            padding: 0;
        }

        .btn-icon i {
            font-size: 18px;
        }
    </style>
@endsection