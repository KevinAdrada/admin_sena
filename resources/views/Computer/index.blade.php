@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px; padding-bottom: 100px;">
    <div class="card shadow-sm border-0">
        <div class="card-header text-white p-4 shadow-sm"
            style="background: linear-gradient(135deg, #2ecc71 0%, #00b646 100%);">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h3 class="mb-0 fw-bold">Listado de Computadoras</h3>
                    <p class="mb-0 text-white-50 small">Gestiona los equipos de cómputo asignados a cada ambiente de formación.</p>
                </div>
                @auth
                    <a href="{{ route('computer.create') }}"
                        class="btn btn-outline-light btn-sm fw-bold d-inline-flex align-items-center px-3 py-1 shadow-sm"
                        style="border-width: 2px; border-radius: 1rem;">
                        <i class="bi bi-plus-circle me-1"></i> Registrar Computadora
                    </a>
                @endauth
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
                            <th class="py-3 ps-3">Imagen</th>
                            <th class="py-3 text-start">Número serie</th>
                            <th class="py-3 text-start">Marca</th>
                            <th class="py-3 text-start">Ambiente Asignado</th>
                            <th class="py-3 text-center" style="width: 197px; min-width: 197px; max-width: 197px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($computers as $computer)
                            @php
                                $imageModel = $computer->images->first();
                                $imagenPath = $imageModel->imagen ?? null;
                            @endphp
                            <tr class="text-center">
                                <td class="ps-3">
                                    @if (!empty($imagenPath))
                                        <img src="{{ asset('storage/images/' . $imagenPath) }}" alt="Computadora #{{ $computer->number }}" class="rounded-3 object-fit-cover shadow-sm" style="width: 40px; height: 40px;">
                                    @else
                                        <div class="bg-light text-secondary rounded-3 d-flex align-items-center justify-content-center border mx-auto" style="width: 40px; height: 40px;">
                                            <i class="bi bi-pc-display fs-6"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-bold text-dark text-start">
                                    {{ $computer->number }}
                                </td>
                                <td class="text-start">
                                    <span class="badge bg-light text-dark border px-2 py-1 fw-semibold">{{ $computer->brand }}</span>
                                </td>
                                <td class="text-secondary text-start">
                                    <i class="bi bi-building me-1"></i> {{ $computer->environment->name ?? 'Sin ambiente' }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <a href="{{ route('computer.show', $computer->id) }}"
                                            class="btn btn-outline-info btn-icon" title="Ver detalles">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @auth
                                            <a href="{{ route('computer.edit', $computer->id) }}"
                                                class="btn btn-outline-primary btn-icon" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('computer.destroy', $computer->id) }}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de eliminar esta computadora?');"
                                                class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-icon" title="Eliminar">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        @endauth
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="bi bi-pc fs-2 d-block mb-2"></i>
                                    No hay computadoras registradas actualmente.
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