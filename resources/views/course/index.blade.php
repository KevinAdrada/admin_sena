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
                    <th class="text-center" style="width: 197px; min-width: 197px; max-width: 197px;">Acciones</th>
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
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <a href="{{ route('course.show', $course->id) }}"
                                        class="btn btn-sm btn-outline-success d-inline-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 30px;">
                                        <i class="bi bi-eye" style="font-size: 20px"></i>
                                    </a>
                                    <a href="{{ route('course.edit', $course->id) }}"
                                        class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 30px;">
                                        <i class="bi bi-pencil" style="font-size: 18px"></i>
                                    </a>
                                    <form action="{{ route('course.destroy', $course->id) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este curso?')"
                                        class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 30px;">
                                            <i class="bi bi-trash3" style="font-size: 18px"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection