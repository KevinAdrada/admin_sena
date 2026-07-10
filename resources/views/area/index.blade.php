@extends('layouts.app')

@section('content')
    <div class="container my-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0 text-dark fw-bold text-uppercase fs-3">Listar Áreas</h1>

            <a href="{{ route('area.create') }}"
                class="btn fw-semibold text-white px-3 py-2 d-inline-flex align-items-center shadow-sm"
                style="background-color: #00b646; border-radius: 0.5rem;">
                <i class="bi bi-plus-circle me-2 fs-5"></i> Crear Área
            </a>
        </div>

        <div class="table-responsive shadow-sm rounded">
            <table id="idArea" class="table table-striped table-bordered align-middle mb-0" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th class="text-center" style="width: 200px; min-width: 150px; max-width: 200px;">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($areas as $area)
                        <tr>
                            <td>{{ $area->id }}</td>
                            <td>{{ $area->name }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <a href="{{ route('area.show', $area->id) }}"
                                        class="btn btn-sm btn-outline-success px-3">
                                        <i class="bi bi-eye" style="font-size: 18px"></i>
                                    </a>
                                    <a href="{{ route('area.edit', $area->id) }}"
                                        class="btn btn-sm btn-outline-primary px-3">
                                        <i class="bi bi-pencil" style="font-size: 18px"></i>
                                    </a>
                                    <form action="{{ route('area.destroy', $area->id) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este área?')"
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
