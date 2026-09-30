@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <!-- Encabezado con Degradado Corporativo -->
                <div class="card-header text-white p-4 shadow-sm"
                    style="background: linear-gradient(135deg, #2ecc71 0%, #00b646 100%); border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-white text-success rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                style="width: 50px; height: 50px;">
                                <i class="bi bi-laptop fs-3"></i>
                            </div>
                            <div>
                                <h3 class="mb-0 fw-bold">Editar Computadora</h3>
                                <p class="mb-0 text-white-50 small">Actualizar información del equipo</p>
                            </div>
                        </div>
                        <a href="{{ route('computer.index') }}"
                            class="btn btn-outline-light btn-sm fw-bold d-inline-flex align-items-center px-3 py-1 shadow-sm"
                            style="border-width: 2px; border-radius: 1rem;">
                            <i class="bi bi-arrow-left me-1"></i> Volver
                        </a>
                    </div>
                </div>

                <!-- Cuerpo del Formulario -->
                <div class="card-body p-4 bg-light">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('computer.update', $computer->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card border-0 shadow-sm p-3 mb-4">
                            <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                <i class="bi bi-hdd-rack-fill me-2"></i> Detalles del Equipo y Fotografía
                            </h5>

                            <div class="row align-items-center mb-3">
                                <div class="col-md-3 text-center mb-3 mb-md-0">
                                    @php
                                        $imageModel = $computer->images->first();
                                        $imagenPath = $imageModel->imagen ?? $imageModel->url ?? $imageModel->path ?? null;
                                        $avatar = $imagenPath
                                            ? asset('storage/images/' . $imagenPath)
                                            : asset('images/default-computer.png');
                                    @endphp
                                    <img src="{{ $avatar }}" alt="Foto actual"
                                        class="rounded shadow-sm border mb-2"
                                        style="width: 80px; height: 70px; object-fit: cover;">
                                    <div class="text-muted small">Equipo actual</div>

                                    @if ($imageModel)
                                        <div class="form-check form-switch mt-2 d-flex justify-content-center">
                                            <input class="form-check-input text-danger" type="checkbox"
                                                name="remove_image" id="remove_image" value="1"
                                                style="cursor: pointer;">
                                            <label class="form-check-label text-danger small ms-2 fw-semibold"
                                                for="remove_image" style="cursor: pointer;">Eliminar foto</label>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <label for="imagen" class="form-label fw-semibold">Cambiar Fotografía <span
                                            class="text-muted fw-normal small">(Opcional)</span></label>
                                    <input type="file" name="imagen" id="imagen"
                                        class="form-control @error('imagen') is-invalid @enderror" accept="image/*">
                                    <div class="form-text small text-muted">Si seleccionas una nueva foto, reemplazará a la actual automáticamente.</div>
                                    @error('imagen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="number" class="form-label fw-semibold">Número de Equipo / Identificador</label>
                                    <input type="number" min="1" name="number" id="number"
                                        class="form-control @error('number') is-invalid @enderror"
                                        value="{{ old('number', $computer->number) }}" required>
                                    @error('number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="brand" class="form-label fw-semibold">Marca de la Computadora</label>
                                    <input type="text" name="brand" id="brand"
                                        class="form-control @error('brand') is-invalid @enderror"
                                        value="{{ old('brand', $computer->brand) }}" required>
                                    @error('brand')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm p-3 mb-4">
                            <h5 class="text-success fw-bold mb-3 border-bottom pb-2">
                                <i class="bi bi-geo-alt-fill me-2"></i> Ubicación del Equipo
                            </h5>

                            <div class="mb-3">
                                <label for="environment_id" class="form-label fw-semibold">Ambiente de Formación</label>
                                <select name="environment_id" id="environment_id"
                                    class="form-select @error('environment_id') is-invalid @enderror" required>
                                    <option value="" disabled>Seleccione un ambiente...</option>
                                    @foreach ($environments as $environment)
                                        <option value="{{ $environment->id }}" {{ old('environment_id', $computer->environment_id) == $environment->id ? 'selected' : '' }}>
                                            {{ $environment->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('environment_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                            <a href="{{ route('computer.index') }}" class="btn btn-secondary px-4 fw-semibold"
                                style="border-radius: 0.5rem;">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-success px-4 fw-semibold shadow-sm"
                                style="border-radius: 0.5rem; background-color: #2ecc71; border-color: #2ecc71;">
                                Actualizar Computadora
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection