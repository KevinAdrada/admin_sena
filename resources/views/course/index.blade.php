@extends('layouts.app')

@section('content')
<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0 text-dark fw-bold text-uppercase fs-3">Listar Cursos</h1>
        
        <a href="{{ route('course.create') }}" class="btn fw-semibold text-white px-3 py-2 d-inline-flex align-items-center shadow-sm" style="background-color: #00b646; border-radius: 0.5rem;">
            <i class="bi bi-plus-circle me-2 fs-5"></i> Crear Curso
        </a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table id="idCourse" class="table table-striped table-bordered align-middle mb-0" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th>Id</th>
                    <th>Numero de Curso</th>
                    <th>Día</th>
                    <th>Área</th>
                    <th>Centro de Formación</th>
                    <th class="text-center" colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{$course->id }}</td>
                        <td>{{$course->course_number }}</td>
                        <td>{{ \Carbon\Carbon::parse($course['day'])->format('d/m/Y') }}</td>
                        <td>{{$course->area->name }}</td>
                        <td>{{$course->training_center->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('course.show', $course->id) }}" class="btn btn-sm btn-outline-success px-3">
                                Mostrar
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('course.edit', $course->id) }}" class="btn btn-sm btn-outline-primary px-3">
                                Editar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection