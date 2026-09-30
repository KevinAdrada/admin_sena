@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white p-4 shadow-sm"
                        style="background: linear-gradient(135deg, #2ecc71 0%, #00b646 100%); border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-white text-success rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-door-open-fill fs-3"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0 fw-bold">Crear Ambiente</h3>
                                    <p class="mb-0 text-white-50 small">Registra un nuevo ambiente en el sistema</p>
                                </div>
                            </div>
                            <a href="{{ route('environment.index') }}"
                                class="btn btn-outline-light btn-sm fw-bold d-inline-flex align-items-center px-3 py-1 shadow-sm"
                                style="border-width: 2px; border-radius: 1rem;">
                                <i class="bi bi-arrow-left me-1"></i> Volver
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4 bg-light">
                        {{-- Mostrar errores de validación --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('environment.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card border-0 shadow-sm p-3 mb-4">
                                <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                    <i class="bi bi-info-circle-fill me-2"></i> Datos del Ambiente
                                </h5>

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">Nombre del Ambiente</label>
                                    <input type="text" name="name" id="name" 
                                           class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Ej. Laboratorio de Software" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label fw-semibold">Ubicación</label>
                                    <input type="text" name="location" id="location" 
                                           class="form-control form-control-lg @error('location') is-invalid @enderror" value="{{ old('location') }}" placeholder="Ej. Bloque 3, Piso 2">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="training_center_id" class="form-label fw-semibold">Centro de Formación</label>
                                    <select name="training_center_id" id="training_center_id" class="form-select form-select-lg @error('training_center_id') is-invalid @enderror" required>
                                        <option value="">Seleccione un centro</option>
                                        @foreach($trainingCenters as $center)
                                            <option value="{{ $center->id }}" 
                                                {{ old('training_center_id') == $center->id ? 'selected' : '' }}>
                                                {{ $center->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('training_center_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label fw-semibold">Imagen del Ambiente</label>
                                    <input type="file" name="image" id="image" class="form-control form-control-lg @error('image') is-invalid @enderror" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                                <a href="{{ route('environment.index') }}" class="btn btn-secondary px-4 fw-semibold"
                                    style="border-radius: 0.5rem;">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-success px-4 fw-semibold shadow-sm"
                                    style="border-radius: 0.5rem; background-color: #2ecc71; border-color: #2ecc71;">
                                    Guardar Ambiente
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection