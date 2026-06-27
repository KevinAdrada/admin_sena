@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light py-3">
                    <h5 class="card-title mb-0 text-dark-emphasis text-centerfw-bold">
                        Registrar Centro de Formación
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{route('training_center.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-secondary">Nombre del Centro</label>
                            <input type="text" 
                                   class="form-control form-control-lg" 
                                   id="name" 
                                   name="name" 
                                   placeholder="Ej. Centro de Comercio y Servicios"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="location" class="form-label fw-semibold text-secondary">Ubicación / Dirección</label>
                            <input type="text" 
                                   class="form-control form-control-lg" 
                                   id="location" 
                                   name="location" 
                                   placeholder="Ej. Calle 4 # 2-100"
                                   required>
                        </div>

                        <div class="d-grid gap-2 mt-5">
                            <button class="btn btn-primary btn-lg shadow-sm" type="submit">
                                Enviar formulario
                            </button>
                            <a href="/training_center/create" class="btn btn-link btn-sm text-secondary text-decoration-none text-center">
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