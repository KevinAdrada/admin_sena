@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="card shadow-sm border-0">
            <div class="card-header text-white p-4 shadow-sm"
                style="background: linear-gradient(135deg, #2ecc71 0%, #00b646 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="mb-0 fw-bold">Cursos</h3>
                        <p class="mb-0 text-white-50 small">Gestión y control de los cursos registrados</p>
                    </div>
                    <a href="{{ route('course.create') }}" 
                        class="btn btn-outline-light btn-sm fw-bold d-inline-flex align-items-center px-3 py-1 shadow-sm"
                        style="border-width: 2px; border-radius: 1rem;">
                        <i class="bi bi-plus-circle me-1"></i> Nuevo Curso
                    </a>
                </div>
            </div>

            <div class="card-body p-4 bg-light">
                @if(session('success'))
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
                                <th class="text-start">Nombre</th>
                                <th>Número</th>
                                <th>Tipo</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Ambiente</th>
                                <th class="text-center" style="width: 197px; min-width: 197px; max-width: 197px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($courses as $course)
                                <tr class="text-center">
                                    <td>{{ $course->id }}</td>
                                    <td class="fw-semibold text-start">{{ $course->course_name }}</td>
                                    <td>{{ $course->course_number }}</td>
                                    <td>{{ $course->program_type }}</td>
                                    <td>{{ \Carbon\Carbon::parse($course->start_date)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($course->end_date)->format('d/m/Y') }}</td>
                                    <td>{{ $course->environment->name ?? 'N/A' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <a href="{{ route('course.show', $course->id) }}"
                                                class="btn btn-outline-success btn-icon" title="Ver">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('course.edit', $course->id) }}"
                                                class="btn btn-outline-primary btn-icon" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('course.destroy', $course->id) }}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de eliminar este curso?');" class="m-0">
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
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="bi bi-folder-x fs-2 d-block mb-2"></i>
                                        No hay cursos registrados todavía.
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