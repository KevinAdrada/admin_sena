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
                        <i class="bi bi-calendar-plus-fill fs-3"></i>
                    </div>
                    <div>
                        <h3 class="mb-0 fw-bold">Crear Nuevo Evento</h3>
                        <p class="mb-0 text-white-50 small">Registra un evento o actividad para el centro de formación</p>
                    </div>
                </div>
                <a href="{{ route('home') }}#eventos"
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

            <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card border-0 shadow-sm p-3 mb-4 rounded-3">
                    <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                        <i class="bi bi-info-circle-fill me-2"></i> Detalles del Evento
                    </h5>

                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold text-dark">Título del Evento</label>
                        <input type="text" class="form-control form-control-lg rounded-3 @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Ej. Jornada de integración SENA" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold text-dark">Descripción</label>
                        <textarea class="form-control rounded-3 @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Detalles de la actividad..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="card border-0 shadow-sm p-3 mb-4 rounded-3">
                    <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                        <i class="bi bi-clock-map me-2"></i> Programación y Ubicación
                    </h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="event_date" class="form-label fw-semibold text-dark">Fecha del Evento</label>
                            <input type="date" class="form-control form-control-lg rounded-3 @error('event_date') is-invalid @enderror" id="event_date" name="event_date" value="{{ old('event_date') }}" required>
                            @error('event_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="event_time" class="form-label fw-semibold text-dark">Hora</label>
                            <input type="time" class="form-control form-control-lg rounded-3 @error('event_time') is-invalid @enderror" id="event_time" name="event_time" value="{{ old('event_time') }}" required>
                            @error('event_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label fw-semibold text-dark">Ubicación / Punto de encuentro</label>
                        <input type="text" class="form-control form-control-lg rounded-3 @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" placeholder="Ej. Auditorio Principal o Bloque B" required>
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card border-0 shadow-sm p-3 mb-4 rounded-3">
                    <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                        <i class="bi bi-building me-2"></i> Asignación y Multimedia
                    </h5>

                    <div class="mb-3">
                        <label for="training_center_id" class="form-label fw-semibold text-dark">Centro de Formación</label>
                        <select class="form-select form-select-lg rounded-3 @error('training_center_id') is-invalid @enderror" id="training_center_id" name="training_center_id" required>
                            <option value="" selected disabled>Seleccione un centro...</option>
                            @foreach ($trainingCenters as $center)
                                <option value="{{ $center->id }}" {{ old('training_center_id') == $center->id ? 'selected' : '' }}>
                                    {{ $center->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('training_center_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label fw-semibold text-dark">Imagen del Evento</label>
                        <input type="file" class="form-control form-control-lg rounded-3 @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                    <a href="{{ route('home') }}#eventos" class="btn btn-secondary px-4 rounded-3 fw-semibold">Cancelar</a>
                    <button type="submit" class="btn text-white px-4 rounded-3 fw-semibold shadow-sm" style="background-color: #2ecc71; border-color: #2ecc71;">Guardar Evento</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection