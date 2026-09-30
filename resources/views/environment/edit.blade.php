@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white p-4 shadow-sm"
                        style="background: linear-gradient(135deg, #2ecc71 0%, #00b646 100%); border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-white text-success rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-door-open fs-3"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0 fw-bold">Editar Ambiente</h3>
                                    <p class="mb-0 text-white-50 small">Actualizar información del ambiente</p>
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

                        <form action="{{ route('environment.update', $environment->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <div class="card border-0 shadow-sm p-3 mb-4">
                                <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                    <i class="bi bi-info-circle-fill me-2"></i> Información General
                                </h5>

                                <div class="row align-items-center">
                                    @if ($environment->images->count())
                                        <div class="col-md-3 text-center mb-3 mb-md-0">
                                            <img src="{{ asset('storage/images/' . $environment->images->first()->imagen) }}"
                                                alt="Imagen ambiente" class="rounded-circle shadow-sm border mb-2"
                                                style="width: 70px; height: 70px; object-fit: cover;">
                                            <div class="text-muted small">Foto actual</div>
                                        </div>
                                        <div class="col-md-9">
                                        @else
                                            <div class="col-12">
                                    @endif
                                    <label for="imagen" class="form-label fw-semibold">Cambiar Fotografía <span
                                            class="text-muted fw-normal small">(Opcional)</span></label>
                                    <input type="file" name="imagen" id="imagen"
                                        class="form-control @error('imagen') is-invalid @enderror" accept="image/*">
                                    <div class="form-text small text-muted">Si subes una nueva imagen, reemplazará la
                                        existente automáticamente.</div>
                                    @error('imagen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3" style="margin-top: 15px">
                                <label for="name" class="form-label fw-semibold">Nombre del Ambiente</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $environment->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="location" class="form-label fw-semibold">Ubicación</label>
                                <input type="text" name="location" id="location"
                                    class="form-control @error('location') is-invalid @enderror"
                                    value="{{ old('location', $environment->location) }}">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="training_center_id" class="form-label fw-semibold">Centro de Formación</label>
                                <select name="training_center_id" id="training_center_id"
                                    class="form-select @error('training_center_id') is-invalid @enderror" required>
                                    <option value="">Seleccione un centro...</option>
                                    @foreach ($trainingCenters as $center)
                                        <option value="{{ $center->id }}"
                                            {{ old('training_center_id', $environment->training_center_id) == $center->id ? 'selected' : '' }}>
                                            {{ $center->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('training_center_id')
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
                            Actualizar Ambiente
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
