@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light py-3">
                    <h5 class="card-title mb-0 text-dark-emphasis text-center fw-bold">
                        Registrar Curso / Ficha
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{route('course.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="course_number" class="form-label fw-semibold text-secondary">Número de Curso</label>
                                <input type="number" 
                                       class="form-control form-control-lg" 
                                       id="course_number" 
                                       name="course_number" 
                                       placeholder="Ej. 2554321"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label for="day" class="form-label fw-semibold text-secondary">Fecha de Inicio / Día</label>
                                <input type="date" 
                                       class="form-control form-control-lg" 
                                       id="day" 
                                       name="day" 
                                       required>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="area_id" class="form-label fw-semibold text-secondary">Área</label>
                                <select name="area_id" id="area_id" class="form-select form-select-lg" required>
                                    <option value="" selected disabled>Seleccione área</option>
                                    @foreach($areas as $area)
                                        <option value="{{$area->id}}">
                                            {{$area->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="training_center_id" class="form-label fw-semibold text-secondary">Centro de Formación</label>
                                <select name="training_center_id" id="training_center_id" class="form-select form-select-lg" required>
                                    <option value="" selected disabled>Seleccione un centro</option>
                                    @foreach($training_centers as $training_center)
                                        <option value="{{$training_center->id}}">
                                            {{$training_center->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-5">
                            <button class="btn btn-primary btn-lg shadow-sm" type="submit">
                                Enviar formulario
                            </button>
                            <a href="/course/create" class="btn btn-link btn-sm text-secondary text-decoration-none text-center">
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