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
                                    <i class="bi bi-building fs-3"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0 fw-bold">Editar Centro de Formación</h3>
                                    <p class="mb-0 text-white-50 small">Actualizar información del centro</p>
                                </div>
                            </div>
                            <a href="/training_center/list"
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

                        <form action="{{ route('training_center.update', $training_center->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card border-0 shadow-sm p-3 mb-4">
                                <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                    <i class="bi bi-info-circle-fill me-2"></i> Información General
                                </h5>

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">Nombre del Centro</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                        placeholder="Ej. Centro de Comercio y Servicios" required
                                        value="{{ old('name', $training_center->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label fw-semibold">Ubicación / Dirección</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location"
                                        placeholder="Ej. Calle 4 # 2-100" required
                                        value="{{ old('location', $training_center->location) }}">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm p-3 mb-4">
                                <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                    <i class="bi bi-images me-2"></i> Fotografías del Centro
                                </h5>

                                @if ($training_center->images->count())
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-muted small">Imágenes actuales</label>
                                        <div class="d-flex flex-wrap gap-3">
                                            @foreach ($training_center->images as $img)
                                                <div class="p-1 bg-white border rounded shadow-sm">
                                                    <img src="{{ asset('storage/images/' . $img->imagen) }}" alt="Imagen actual"
                                                        width="120" height="90" class="rounded object-fit-cover">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label for="imagenes" class="form-label fw-semibold">Agregar / Cambiar Imágenes</label>
                                    <input type="file" class="form-control @error('imagenes.*') is-invalid @enderror" id="imagenes" name="imagenes[]"
                                        accept="image/*" multiple>
                                    <div class="form-text small text-muted">Puedes seleccionar varias imágenes a la vez para añadirlas.</div>
                                    @error('imagenes.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                                <a href="/training_center/list" class="btn btn-secondary px-4 fw-semibold"
                                    style="border-radius: 0.5rem;">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-success px-4 fw-semibold shadow-sm"
                                    style="border-radius: 0.5rem; background-color: #2ecc71; border-color: #2ecc71;">
                                    Actualizar Datos
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection