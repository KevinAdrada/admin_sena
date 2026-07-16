@extends('layouts.app')
@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                <div class="card shadow-sm border-0">
                    <div class="card-header py-3" style="background-color: #19d360;">
                        <h5 class="card-title mb-0 text-white text-center fw-bold">
                            Editar Centro de Formación
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('training_center.update', $training_center->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold text-secondary">Nombre del Centro</label>
                                <input type="text" class="form-control form-control-lg" id="name" name="name"
                                    placeholder="Ej. Centro de Comercio y Servicios" required value="{{ old('name', $training_center->name) }}">
                            </div>

                            <div class="mb-4">
                                <label for="location" class="form-label fw-semibold text-secondary">Ubicación / Dirección</label>
                                <input type="text" class="form-control form-control-lg" id="location" name="location"
                                    placeholder="Ej. Calle 4 # 2-100" required value="{{ old('location', $training_center->location) }}">
                            </div>

                            <div class="d-grid gap-2 mt-5">
                                <button type="submit"
                                    class="btn text-white fw-bold px-4 py-2 fs-5 text-decoration-none text-center shadow-sm"
                                    style="background-color: #00b646; border-radius: 0.5rem;">
                                    Actualizar Datos
                                </button>
                                <a href="/training_center/list"
                                    class="btn btn-link btn-sm text-secondary text-decoration-none text-center">
                                    Cancelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
