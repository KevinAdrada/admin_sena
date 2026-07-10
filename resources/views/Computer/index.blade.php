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
                    <th class="text-center" colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($computers as $computer)
                    <tr>
                        <td>{{ $computer->id }}</td>
                        <td>{{ sprintf('%03d', $computer->number) }}</td>
                        <td>{{ $computer->brand }}</td>
                        <td class="text-center">
                            <a href="{{ route('computer.show', $computer->id) }}" class="btn btn-sm btn-outline-success px-3">
                                Mostrar
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('computer.edit', $computer->id) }}" class="btn btn-sm btn-outline-primary px-3">
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