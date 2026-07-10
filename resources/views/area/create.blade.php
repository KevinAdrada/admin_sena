@extends('layouts.app')
@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">

                <div class="card shadow-sm border-0">
                    <div class="card-header py-3" style="background-color: #19d360;">
                        <h5 class="card-title mb-0 text-white text-center fw-bold">
                            Registrar Área
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('area.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold text-secondary">Nombre del Área</label>
                                <input type="text" class="form-control form-control-lg" id="name" name="name"
                                    placeholder="Ej. Teleinformática" required>
                            </div>

                            <div class="d-grid gap-2 mt-5">
                                <button type="submit"
                                    class="btn text-white fw-bold px-4 py-2 fs-5 text-decoration-none text-center shadow-sm"
                                    style="background-color: #00b646; border-radius: 0.5rem;">
                                    Enviar formulario
                                </button>
                                <a href="/area/list"
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
