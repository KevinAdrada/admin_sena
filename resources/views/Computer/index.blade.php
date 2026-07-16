@extends('layouts.app')

@section('content')
<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0 text-dark fw-bold text-uppercase fs-3">Listar Computadores</h1>
        
        <a href="{{ route('computer.create') }}" class="btn fw-semibold text-white px-3 py-2 d-inline-flex align-items-center shadow-sm" style="background-color: #00b646; border-radius: 0.5rem;">
            <i class="bi bi-plus-circle me-2 fs-5"></i> Crear Computador
        </a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table id="idComputer" class="table table-striped table-bordered align-middle mb-0" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th>Id</th>
                    <th>Numero</th>
                    <th>Marca</th>
                    <th class="text-center" style="width: 197px; min-width: 197px; max-width: 197px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($computers as $computer)
                    <tr>
                        <td>{{ $computer->id }}</td>
                        <td>{{ sprintf('%03d', $computer->number) }}</td>
                        <td>{{ $computer->brand }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <a href="{{ route('computer.show', $computer->id) }}"
                                    class="btn btn-sm btn-outline-success d-inline-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 30px;">
                                    <i class="bi bi-eye" style="font-size: 20px"></i>
                                </a>
                                <a href="{{ route('computer.edit', $computer->id) }}"
                                    class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 30px;">
                                    <i class="bi bi-pencil" style="font-size: 18px"></i>
                                </a>
                                <form action="{{ route('computer.destroy', $computer->id) }}" method="POST"
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este computador?')"
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