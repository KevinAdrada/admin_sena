@extends('layouts.app')

@section('content')
    <div class="container my-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0 text-dark fw-bold text-uppercase fs-3">Listar Aprendices</h1>

            <a href="{{ route('apprentice.create') }}"
                class="btn fw-semibold text-white px-3 py-2 d-inline-flex align-items-center shadow-sm"
                style="background-color: #00b646; border-radius: 0.5rem;">
                <i class="bi bi-plus-circle me-2 fs-5"></i> Crear Aprendiz
            </a>
        </div>

        <div class="table-responsive shadow-sm rounded">
            <table id="idApprentice" class="table table-striped table-bordered align-middle mb-0" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Número de teléfono</th>
                        <th>Id curso</th>
                        <th>Id computador</th>
                        <th class="text-center" colspan="3" width="150">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($apprentices as $apprentice)
                        <tr>
                            <td>{{ $apprentice->id }}</td>
                            <td>{{ $apprentice->name }}</td>
                            <td>{{ $apprentice->email }}</td>
                            <td>{{ $apprentice->cell_number }}</td>
                            <td>{{ $apprentice->course->course_number }}</td>
                            <td>{{ $apprentice->computer->brand }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">

                                    <!-- Botón Ver -->
                                    <a href="{{ route('apprentice.show', $apprentice->id) }}"
                                        class="btn btn-sm btn-outline-success d-inline-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 35px;">
                                        <i class="bi bi-eye" style="font-size: 18px"></i>
                                    </a>

                                    <!-- Botón Editar -->
                                    <a href="{{ route('apprentice.edit', $apprentice->id) }}"
                                        class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 35px;">
                                        <i class="bi bi-pencil" style="font-size: 18px"></i>
                                    </a>

                                    <!-- Botón Eliminar (Formulario) -->
                                    <form action="{{ route('apprentice.destroy', $apprentice->id) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este aprendiz?')"
                                        class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 35px;">
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
