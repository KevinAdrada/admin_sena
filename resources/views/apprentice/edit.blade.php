@extends('layouts.app')
@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">

                <div class="card shadow-sm border-0">
                    <div class="card-header py-3" style="background-color: #19d360;">
                        <h5 class="card-title mb-0 text-white text-center fw-bold">
                            Editar Aprendiz
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('apprentice.update', $apprentice->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold text-secondary">Nombre Completo</label>
                                <input type="text" class="form-control form-control-lg" id="name" name="name"
                                    placeholder="Ej. Juan Pérez" required value="{{ old('name', $apprentice->name) }}">
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold text-secondary">Correo
                                    Electrónico</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email"
                                    placeholder="ejemplo@correo.com" required
                                    value="{{ old('email', $apprentice->email) }}">
                            </div>

                            <div class="mb-4">
                                <label for="cell_number" class="form-label fw-semibold text-secondary">Número de
                                    Teléfono</label>
                                <input type="number" class="form-control form-control-lg" id="cell_number"
                                    name="cell_number" placeholder="Ej. 3001234567" required
                                    value="{{ old('cell_number', $apprentice->cell_number) }}">
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="course_id" class="form-label fw-semibold text-secondary">Curso</label>
                                    <select name="course_id" id="course_id" class="form-select form-select-lg" required>
                                        <option value="" disabled
                                            {{ old('course_id', $apprentice->course_id ?? '') == '' ? 'selected' : '' }}>
                                            Seleccione un curso
                                        </option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}"
                                                {{ old('course_id', $apprentice->course_id ?? '') == $course->id ? 'selected' : '' }}>
                                                {{ $course->course_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="computer_id" class="form-label fw-semibold text-secondary">Equipo</label>
                                    <select name="computer_id" id="computer_id" class="form-select form-select-lg" required>
                                        <option value="" disabled
                                            {{ old('computer_id', $apprentice->computer_id ?? '') == '' ? 'selected' : '' }}>
                                            Seleccione un equipo
                                        </option>
                                        @foreach ($computers as $computer)
                                            <option value="{{ $computer->id }}"
                                                {{ old('computer_id', $apprentice->computer_id ?? '') == $computer->id ? 'selected' : '' }}>
                                                {{ $computer->brand }}
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
                                <a href="/apprentice/list"
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
