@extends('layouts.auth')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center rounded-4 border-0 shadow-sm mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-5 text-white d-flex flex-column align-items-center justify-content-center p-4 text-center position-relative" 
                             style="background-color: #00b646;">
                            
                            <a href="javascript:history.back()" 
                               class="btn btn-light rounded-circle position-absolute top-0 start-0 m-3 shadow-sm btn-back-circle" 
                               title="Volver atrás">
                                <i class="bi bi-arrow-left"></i>
                            </a>
                            
                            <div class="position-relative mb-3 mt-4 mt-md-0">
                                <div class="rounded-circle bg-white text-dark fw-bold d-flex align-items-center justify-content-center shadow-sm"
                                    style="width: 100px; height: 100px; font-size: 2.5rem; color: #00b646 !important;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>

                                <label for="profile_photo_input" 
                                       class="btn btn-light rounded-circle position-absolute bottom-0 end-0 shadow-sm btn-edit-avatar" 
                                       title="Cambiar foto de perfil">
                                    <i class="bi bi-pencil-fill"></i>
                                </label>
                            </div>
                            
                            <h4 class="fw-bold mb-1">{{ Auth::user()->name }}</h4>
                            <p class="mb-0 opacity-75 small text-break">{{ Auth::user()->email }}</p>
                            
                            <span class="badge bg-white text-dark mt-3 px-3 py-2 rounded-pill fw-semibold shadow-sm" style="color: #00b646 !important;">
                                Administrador Sena
                            </span>
                        </div>

                        <div class="col-md-7 bg-white p-4 p-md-5">
                            
                            <div class="mb-4">
                                <h3 class="fw-bold text-dark mb-1">Mi Perfil</h3>
                                <p class="text-muted small">Actualiza tus datos personales y configuración de cuenta</p>
                            </div>

                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="file" id="profile_photo_input" name="profile_photo" class="d-none" accept="image/*">

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold text-secondary small text-uppercase">Nombre Completo</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control bg-light border-start-0 @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                    </div>
                                    @error('name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="form-label fw-bold text-secondary small text-uppercase">Correo Electrónico</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control bg-light border-start-0 @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                    </div>
                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <hr class="my-4 text-muted opacity-25">

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold text-secondary small text-uppercase">Nueva Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control bg-light border-start-0 @error('password') is-invalid @enderror" 
                                               id="password" name="password" placeholder="Opcional">
                                    </div>
                                    @error('password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label fw-bold text-secondary small text-uppercase">Confirmar Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-shield-lock"></i></span>
                                        <input type="password" class="form-control bg-light border-start-0" 
                                               id="password_confirmation" name="password_confirmation" placeholder="Repite la contraseña">
                                    </div>
                                </div>
                                <button type="submit" class="btn-sena-green">
                                    Guardar Cambios
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .btn-back-circle {
        width: 40px;
        height: 40px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #00b646;
        border: none;
        transition: all 0.2s ease;
    }

    .btn-back-circle i {
        font-size: 1.5rem;
        line-height: 1;
    }

    .btn-back-circle:hover {
        background-color: #00b646;
        color: #ffffff;
        box-shadow: 0 0 0 2px #ffffff !important;
    }

    .btn-edit-avatar {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #00b646;
        border: 2px solid #ffffff;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 2px solid #00b646;
    }

    .btn-edit-avatar i {
        font-size: 0.85rem;
        line-height: 1;
    }

    .btn-edit-avatar:hover {
        background-color: #00b646;
        color: #ffffff;
    }

    .btn-sena-green {
        background-color: #00b646;
        color: #ffffff;
        font-weight: 700;
        border: 2px solid transparent;
        border-radius: 25px;
        padding: 12px;
        width: 100%;
        text-transform: uppercase;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-sena-green:hover {
        background-color: #ffffff;
        color: #00b646;
        border-color: #00b646;
    }
</style>
@endsection