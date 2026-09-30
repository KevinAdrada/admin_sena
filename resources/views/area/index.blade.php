@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="card shadow-sm border-0">
            <div class="card-header text-white p-4 shadow-sm"
                style="background: linear-gradient(135deg, #2ecc71 0%, #00b646 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="mb-0 fw-bold">Áreas</h3>
                        <p class="mb-0 text-white-50 small">Gestión y control de las áreas registradas</p>
                    </div>
                    <a href="{{ route('area.create') }}"
                        class="btn btn-outline-light btn-sm fw-bold d-inline-flex align-items-center px-3 py-1 shadow-sm"
                        style="border-width: 2px; border-radius: 1rem;">
                        <i class="bi bi-plus-circle me-1"></i> Crear Área
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
                    <table id="idArea" class="table table-hover align-middle mb-0" style="width:100%">
                        <thead class="table-light text-center">
                            <tr>
                                <th>Id</th>
                                <th class="text-start">Nombre</th>
                                <th class="text-center" style="width: 197px; min-width: 197px; max-width: 197px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($areas as $area)
                                <tr class="text-center">
                                    <td>{{ $area->id }}</td>
                                    <td class="fw-semibold text-start">{{ $area->name }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <a href="{{ route('area.edit', $area->id) }}"
                                                class="btn btn-outline-primary btn-icon" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('area.destroy', $area->id) }}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta área?');"
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
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        <i class="bi bi-folder-x fs-2 d-block mb-2"></i>
                                        No hay áreas registradas todavía.
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