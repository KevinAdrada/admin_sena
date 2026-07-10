@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <div class="mx-auto mb-3 d-inline-block p-2 text-center" style="background-color: #00b646; border-radius: 2rem;">
            <a href="{{ url()->previous() }}"
                class="btn btn-link text-decoration-none p-0 text-white fw-semibold d-inline-flex align-items-center">
                <i class="bi bi-arrow-left fs-5"></i>
            </a>
        </div>

        <div class="card shadow border-0 overflow-hidden mx-auto" style="max-width: 800px;">

            <div class="card-header bg-gradient text-white p-4" style="background-color: #00b646;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="badge bg-white text-uppercase mb-2 fw-bold" style="color: #00b646;">Ficha de Registro</span>
                        <h2 class="mb-0 fw-light">
                            <strong>{{ $training_center['name'] }}</strong>
                        </h2>
                    </div>
                    <span class="text-white fs-5">ID: #{{ $training_center['id'] }}</span>
                </div>
            </div>

            <div class="card-body p-4 bg-light">

                <div class="row g-4">

                    <div class="col-md-12">  {{-- col-md-12 ocupa toda la fila en pantallas medianas y más grandes --}}
                        <div class="bg-white p-4 rounded shadow-sm h-100">
                            <h5 class="text-secondary border-bottom pb-2 mb-3">Datos del Centro de Formación</h5>

                            <div class="mb-3">
                                <small class="text-muted d-block text-uppercase fw-bold text-xs">Ubicación</small>
                                <span class="text-dark fs-5 fw-semibold">{{ $training_center['location'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-white border-0 px-4 py-3 border-top text-muted fs-7">
                <div class="row text-center text-md-start">
                    <div class="col-md-6 mb-2 mb-md-0">
                        <i class="bi bi-calendar-plus me-1"></i>
                        <strong>Creado el:</strong>
                        {{ \Carbon\Carbon::parse($training_center['created_at'])->format('d/m/Y H:i') }}
                    </div>
                    <div class="col-md-6 text-md-end">
                        <i class="bi bi-arrow-clockwise me-1"></i>
                        <strong>Última actualización:</strong>
                        {{ \Carbon\Carbon::parse($training_center['updated_at'])->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
