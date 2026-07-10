@extends('layouts.app')
@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">

                <div class="card shadow-sm border-0">
                    <div class="card-header py-3" style="background-color: #19d360;">
                        <h5 class="card-title mb-0 text-white text-center fw-bold">
                            Editar Instructor
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('teacher.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-semibold text-secondary">Nombre del
                                        Instructor</label>
                                    <input type="text" class="form-control form-control-lg" id="name" name="name"
                                        placeholder="Ej. Carlos Mendoza" required value="{{ old('name', $teacher->name) }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold text-secondary">Correo
                                        Electrónico</label>
                                    <input type="email" class="form-control form-control-lg" id="email" name="email"
                                        placeholder="instructor@sena.edu.co" required
                                        value="{{ old('email', $teacher->email) }}">
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="area_id" class="form-label fw-semibold text-secondary">Área</label>
                                    <select name="area_id" id="area_id" class="form-select form-select-lg" required>
                                        <option value="" disabled
                                            {{ old('area_id', $teacher->area_id ?? '') == '' ? 'selected' : '' }}>
                                            Seleccione área
                                        </option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}"
                                                {{ old('area_id', $teacher->area_id ?? '') == $area->id ? 'selected' : '' }}>
                                                {{ $area->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="training_center_id" class="form-label fw-semibold text-secondary">Centro de
                                        Formación</label>
                                    <select name="training_center_id" id="training_center_id" class="form-select form-select-lg"
                                        required>
                                        <option value="" disabled
                                            {{ old('training_center_id', $teacher->training_center_id ?? '') == '' ? 'selected' : '' }}>
                                            Seleccione un centro
                                        </option>
                                        @foreach ($training_centers as $training_center)
                                            <option value="{{ $training_center->id }}"
                                                {{ old('training_center_id', $teacher->training_center_id ?? '') == $training_center->id ? 'selected' : '' }}>
                                                {{ $training_center->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-5">
                                <button type="submit"
                                    class="btn text-white fw-bold px-4 py-2 fs-5 text-decoration-none text-center shadow-sm"
                                    style="background-color: #00b646; border-radius: 0.5rem;">
                                    Actualizar Datos
                                </button>
                                <a href="/teacher/list"
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
