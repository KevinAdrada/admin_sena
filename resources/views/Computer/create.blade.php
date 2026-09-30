@extends('layouts.app')

@section('content')
<div class="container mb-5" style="max-width: 800px; padding-bottom: 100px; margin-top: 30px;">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        
        <div class="card-header text-white p-4 shadow-sm"
            style="background: linear-gradient(135deg, #2ecc71 0%, #00b646 100%);">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white text-success rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-pc-display-horizontal fs-3"></i>
                    </div>
                    <div>
                        <h3 class="mb-0 fw-bold">Registrar Computadora</h3>
                        <p class="mb-0 text-white-50 small">Añade un nuevo equipo de cómputo al inventario del ambiente</p>
                    </div>
                </div>
                <a href="{{ route('computer.index') }}" 
                    class="btn btn-outline-light btn-sm fw-bold d-inline-flex align-items-center px-3 py-1 shadow-sm"
                    style="border-width: 2px; border-radius: 1rem;">
                    <i class="bi bi-arrow-left me-1"></i> Volver
                </a>
            </div>
        </div>

        <div class="card-body p-4 p-md-5 bg-light">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('computer.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Identificación y Especificaciones -->
                <div class="card border-0 shadow-sm p-3 mb-4 rounded-3">
                    <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                        <i class="bi bi-cpu-fill me-2"></i> Detalles del Equipo
                    </h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="number" class="form-label fw-semibold text-dark">Número de Equipo / Identificador</label>
                            <input type="number" min="1" class="form-control form-control-lg rounded-3 @error('number') is-invalid @enderror" id="number" name="number" value="{{ old('number') }}" required placeholder="Ej: 1, 12, etc.">
                            @error('number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="brand" class="form-label fw-semibold text-dark">Marca de la Computadora</label>
                            <input type="text" class="form-control form-control-lg rounded-3 @error('brand') is-invalid @enderror" id="brand" name="brand" value="{{ old('brand') }}" required placeholder="Ej: HP, Dell, Lenovo">
                            @error('brand')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Ubicación y Multimedia -->
                <div class="card border-0 shadow-sm p-3 mb-4 rounded-3">
                    <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                        <i class="bi bi-geo-alt-fill me-2"></i> Asignación y Evidencia
                    </h5>

                    <div class="mb-3">
                        <label for="environment_id" class="form-label fw-semibold text-dark">Ambiente de Formación</label>
                        <select class="form-select form-select-lg rounded-3 @error('environment_id') is-invalid @enderror" id="environment_id" name="environment_id" required>
                            <option value="" selected disabled>Seleccione un ambiente...</option>
                            @foreach ($environments as $environment)
                                <option value="{{ $environment->id }}" {{ old('environment_id') == $environment->id ? 'selected' : '' }}>
                                    {{ $environment->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('environment_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="imagen" class="form-label fw-semibold text-dark">Fotografía del Equipo</label>
                        <input type="file" class="form-control form-control-lg rounded-3 @error('imagen') is-invalid @enderror" id="imagen" name="imagen" accept="image/*">
                        @error('imagen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                    <a href="{{ route('computer.index') }}" class="btn btn-secondary px-4 rounded-3 fw-semibold">Cancelar</a>
                    <button type="submit" class="btn text-white px-4 rounded-3 fw-semibold shadow-sm" style="background-color: #2ecc71; border-color: #2ecc71;">Guardar Computadora</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection