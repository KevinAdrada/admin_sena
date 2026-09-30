@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 800px;">
    
    <div class="mb-4">
        <a href="{{ route('event.show', $event->id) }}" class="btn btn-outline-secondary btn-sm fw-bold shadow-sm" style="border-radius: 0.5rem;">
            <i class="bi bi-arrow-left me-1"></i> Volver a los detalles
        </a>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden" style="border-top: 4px solid #00b646 !important; border-radius: 0.5rem;">
        
        <div class="card-header bg-white p-4 border-bottom">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                    style="width: 50px; height: 50px;">
                    <i class="bi bi-pencil-square fs-3"></i>
                </div>
                <div>
                    <span class="badge bg-success bg-opacity-10 text-success text-uppercase mb-1 fw-bold small" style="border-radius: 1rem; padding: 0.25rem 0.6rem;">Gestión de Eventos</span>
                    <h3 class="mb-0 fw-bold text-dark">Editar Evento</h3>
                </div>
            </div>
        </div>

        <div class="card-body p-4 p-md-5 bg-white">

            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 0.5rem;">
                    <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> Por favor corrige los siguientes errores:</div>
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label text-dark fw-bold small text-uppercase">
                        <i class="bi bi-type text-success me-1"></i> Título del Evento <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control shadow-sm" id="title" name="title" value="{{ old('title', $event->title) }}" required style="border-radius: 0.5rem; padding: 0.75rem;">
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="event_date" class="form-label text-dark fw-bold small text-uppercase">
                            <i class="bi bi-calendar-event text-success me-1"></i> Fecha del Evento <span class="text-danger">*</span>
                        </label>
                        <input type="date" class="form-control shadow-sm" id="event_date" name="event_date" value="{{ old('event_date', $event->event_date) }}" required style="border-radius: 0.5rem; padding: 0.75rem;">
                    </div>

                    <div class="col-md-6">
                        <label for="event_time" class="form-label text-dark fw-bold small text-uppercase">
                            <i class="bi bi-clock text-success me-1"></i> Hora <span class="text-danger">*</span>
                        </label>
                        <input type="time" class="form-control shadow-sm" id="event_time" name="event_time" value="{{ old('event_time', $event->event_time) }}" required style="border-radius: 0.5rem; padding: 0.75rem;">
                    </div>
                </div>

                @if(isset($trainingCenters) && count($trainingCenters) > 0)
                <div class="mb-3">
                    <label for="training_center_id" class="form-label text-dark fw-bold small text-uppercase">
                        <i class="bi bi-building text-success me-1"></i> Centro de Formación
                    </label>
                    <select class="form-select shadow-sm" id="training_center_id" name="training_center_id" style="border-radius: 0.5rem; padding: 0.75rem;">
                        <option value="">Seleccione un centro (Opcional)</option>
                        @foreach($trainingCenters as $center)
                            <option value="{{ $center->id }}" {{ old('training_center_id', $event->training_center_id) == $center->id ? 'selected' : '' }}>
                                {{ $center->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="mb-3">
                    <label for="location" class="form-label text-dark fw-bold small text-uppercase">
                        <i class="bi bi-geo-alt-fill text-danger me-1"></i> Ubicación <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control shadow-sm" id="location" name="location" rows="2" required style="border-radius: 0.5rem; padding: 0.75rem;">{{ old('location', $event->location) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label text-dark fw-bold small text-uppercase">
                        <i class="bi bi-info-circle-fill text-success me-1"></i> Descripción del Evento <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control shadow-sm" id="description" name="description" rows="4" required style="border-radius: 0.5rem; padding: 0.75rem;">{{ old('description', $event->description) }}</textarea>
                </div>

                <div class="mb-4 p-3 bg-light rounded shadow-sm border">
                    <label for="imagen" class="form-label text-dark fw-bold small text-uppercase mb-2">
                        <i class="bi bi-image text-success me-1"></i> Cambiar Imagen de Portada
                    </label>
                    
                    @php
                        $imageModel = $event->images->first();
                        $currentImage = $imageModel->imagen ?? $imageModel->url ?? $imageModel->path ?? null;
                    @endphp

                    @if(!empty($currentImage))
                        <div class="mb-3 d-flex align-items-center gap-3">
                            <span class="text-muted small">Actual:</span>
                            <img src="{{ asset('storage/images/' . $currentImage) }}" class="rounded shadow-sm object-fit-cover" style="width: 100px; height: 70px;" alt="Vista previa">
                        </div>
                    @endif

                    <input type="file" class="form-control shadow-sm" id="imagen" name="imagen" accept="image/*" style="border-radius: 0.5rem;">
                    <div class="form-text text-muted small mt-1">Deja este campo en blanco si deseas conservar la imagen actual.</div>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                    <a href="{{ route('event.show', $event->id) }}" class="btn btn-light border px-4 fw-semibold shadow-sm text-secondary" style="border-radius: 0.5rem;">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-success px-4 fw-semibold shadow-sm text-white" style="background-color: #00b646; border-color: #00b646; border-radius: 0.5rem;">
                        <i class="bi bi-check-lg me-1"></i> Guardar Cambios
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection