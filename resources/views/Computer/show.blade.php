@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    
                    <div class="card-header text-white p-4 shadow-sm"
                        style="background: linear-gradient(135deg, #2ecc71 0%, #00b646 100%); border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-white text-success rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-pc-display fs-3"></i>
                                </div>
                                <div>
                                    <span class="badge bg-white text-success text-uppercase mb-1 fw-bold small" style="border-radius: 1rem; padding: 0.25rem 0.6rem;">Equipo de Cómputo</span>
                                    <h3 class="mb-0 fw-bold">Computadora #{{ $computer->number }}</h3>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center gap-2">
                                @auth
                                    <a href="{{ route('computer.edit', $computer->id) }}" class="btn btn-light text-secondary border shadow-sm d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; border-radius: 0.5rem;" title="Editar Computadora">
                                        <i class="bi bi-pencil-square fs-6"></i>
                                    </a>
                                    
                                    <form action="{{ route('computer.destroy', $computer->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta computadora?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light text-danger border shadow-sm d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; border-radius: 0.5rem;" title="Eliminar">
                                            <i class="bi bi-trash3 fs-6"></i>
                                        </button>
                                    </form>
                                @endauth

                                <a href="{{ route('computer.index') }}"
                                    class="btn btn-outline-light btn-sm fw-bold d-inline-flex align-items-center px-3 py-2 shadow-sm"
                                    style="border-width: 2px; border-radius: 0.5rem;">
                                    <i class="bi bi-arrow-left me-1"></i> Volver
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 bg-light">
                        
                        @php
                            $imageModel = $computer->images->first();
                            $imagenPath = $imageModel->imagen ?? null;
                        @endphp

                        @if (!empty($imagenPath))
                            <div class="card border-0 shadow-sm p-2 mb-4 overflow-hidden rounded">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/images/' . $imagenPath) }}"
                                        alt="Computadora #{{ $computer->number }}" class="img-fluid w-100 rounded object-fit-cover" style="max-height: 320px;">
                                    <span class="position-absolute bottom-0 end-0 m-3 badge bg-dark bg-opacity-75 text-white px-3 py-2">
                                        <i class="bi bi-pc-display me-1">ID: #{{ $computer->id }}</i>
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="card border-0 shadow-sm p-4 mb-4 text-center text-muted bg-white">
                                <i class="bi bi-pc-display fs-1 text-black-50 mb-2"></i>
                                <span>Sin fotografía registrada</span>
                            </div>
                        @endif

                        <div class="card border-0 shadow-sm p-4 mb-4">
                            <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                <i class="bi bi-info-circle-fill me-2"></i> Datos del Equipo
                            </h5>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-1">Marca</span>
                                        <span class="text-dark fs-6 fw-semibold">{{ $computer->brand }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border-start border-success border-4">
                                        <span class="text-muted d-block text-uppercase fw-bold small mb-1">Ambiente Asignado</span>
                                        <span class="text-dark fs-6 fw-semibold">{{ $computer->environment->name ?? 'No asignado' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-muted small px-2">
                            <div class="row text-center text-md-start">
                                <div class="col-md-6 mb-1 mb-md-0">
                                    <i class="bi bi-calendar-plus me-1 text-success"></i>
                                    <strong>Creado el:</strong> {{ \Carbon\Carbon::parse($computer->created_at)->format('d/m/Y H:i') }}
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <i class="bi bi-arrow-clockwise me-1 text-success"></i>
                                    <strong>Última actualización:</strong> {{ \Carbon\Carbon::parse($computer->updated_at)->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection