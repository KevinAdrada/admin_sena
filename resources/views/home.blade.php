@extends('layouts.app')

@section('content')
    <div id="home"></div>
    <div id="heroCarousel" class="carousel slide carousel-fade shadow-sm mb-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active" style="height: 400px;" data-bs-interval="3000">
                <img src="https://www.qhubocali.com/wp-content/uploads/2023/05/Sena-.jpg" class="d-block w-100 h-100"
                    style="object-fit: cover;" alt="Instalaciones SENA">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center top-0 bottom-0 start-0 end-0"
                    style="background: rgba(0, 0, 0, 0.55);">
                    <div class="container text-center text-white px-4">
                        <span
                            class="badge bg-white text-success fw-bold px-3 py-2 mb-3 text-uppercase tracking-wider shadow-sm">
                            Panel de Control Institucional
                        </span>
                        <h1 class="display-3 fw-bold mb-2" style="letter-spacing: -1px;">Plataforma Admin SENA</h1>
                        <p class="lead fs-4 opacity-95 fw-light mb-0">Gestión y control de registros académicos
                            institucionales</p>
                    </div>
                </div>
            </div>

            <div class="carousel-item" style="height: 400px;" data-bs-interval="3000">
                <img src="https://certificadossena.net/wp-content/uploads/2022/10/cursos-en-el-sena-programas-formativos-1024x555.jpg"
                    class="d-block w-100 h-100" style="object-fit: cover;" alt="Ambientes de Formación">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center top-0 bottom-0 start-0 end-0"
                    style="background: rgba(0, 0, 0, 0.55);">
                    <div class="container text-center text-white px-4">
                        <span
                            class="badge bg-white text-success fw-bold px-3 py-2 mb-3 text-uppercase tracking-wider shadow-sm">
                            Infraestructura Tecnológica
                        </span>
                        <h1 class="display-4 fw-bold mb-2" style="letter-spacing: -1px;">Control de Ambientes</h1>
                        <p class="lead fs-5 opacity-95 fw-light mb-0">Supervisión eficiente de laboratorios y recursos
                            técnicos</p>
                    </div>
                </div>
            </div>

            <div class="carousel-item" style="height: 400px;" data-bs-interval="3000">
                <img src="https://www.semana.com/resizer/v2/BECP34CL7RBD5LVFMCHQR6VN3I.jpeg?auth=e1104821a501230c6a85f5c506f0f5c9b5fe52ce6e14f9730027c39a916ea841&smart=true&quality=75&width=1280&height=720"
                    class="d-block w-100 h-100" style="object-fit: cover;" alt="Comunidad SENA">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center top-0 bottom-0 start-0 end-0"
                    style="background: rgba(0, 0, 0, 0.6);">
                    <div class="container text-center text-white px-4">
                        <span
                            class="badge bg-success text-white fw-bold px-3 py-2 mb-3 text-uppercase tracking-wider shadow-sm">
                            Comunidad de Conocimiento
                        </span>
                        <h1 class="display-4 fw-bold mb-2" style="letter-spacing: -1px;">Seguimiento Integral</h1>
                        <p class="lead fs-5 opacity-95 fw-light mb-0">Formación profesional integral para el desarrollo
                            social y tecnológico</p>
                    </div>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 class="fw-bold text-dark mb-2 position-relative pb-2">
                    Módulos de Gestión
                    <span class="position-absolute bottom-0 start-50 translate-middle-x bg-success"
                        style="width: 50px; height: 3px; border-radius: 2px;"></span>
                </h2>
                <p class="text-muted">Accede a las principales funcionalidades del sistema administrativo</p>
            </div>
        </div>

        <div class="row g-4 justify-content-center" style="padding-bottom:100px;">

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm card-custom">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-container rounded-3 text-white me-3 d-flex align-items-center justify-content-center"
                                style="background-color: #00b646; width: 45px; height: 45px;">
                                <i class="bi bi-people-fill fs-4"></i>
                            </div>
                            <h3 class="h5 card-title mb-0 fw-bold text-dark">Aprendices</h3>
                        </div>
                        <p class="card-text text-secondary small mb-4">Administra los datos de los estudiantes registrados,
                            fichas y estado académico.</p>
                        <a href="/apprentice/list" class="btn btn-sm w-100 fw-bold"
                            style="color: #00b646; border: 1px solid #00b646;"
                            onmouseover="this.style.backgroundColor='#00b646'; this.style.color='#fff';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#00b646';">Gestionar
                            Aprendices</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm card-custom">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-container rounded-3 text-white me-3 d-flex align-items-center justify-content-center"
                                style="background-color: #00b646; width: 45px; height: 45px;">
                                <i class="bi bi-person-badge-fill fs-4"></i>
                            </div>
                            <h3 class="h5 card-title mb-0 fw-bold text-dark">Instructores</h3>
                        </div>
                        <p class="card-text text-secondary small mb-4">Consulta y organiza la información de los
                            instructores asignados a cada área.</p>
                        <a href="/teacher/list" class="btn btn-sm w-100 fw-bold"
                            style="color: #00b646; border: 1px solid #00b646;"
                            onmouseover="this.style.backgroundColor='#00b646'; this.style.color='#fff';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#00b646';">Gestionar
                            Instructores</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm card-custom">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-container rounded-3 text-white me-3 d-flex align-items-center justify-content-center"
                                style="background-color: #00b646; width: 45px; height: 45px;">
                                <i class="bi bi-journal-bookmark-fill fs-4"></i>
                            </div>
                            <h3 class="h5 card-title mb-0 fw-bold text-dark">Cursos</h3>
                        </div>
                        <p class="card-text text-secondary small mb-4">Controla los programas de formación y las
                            asignaturas activas en el centro.</p>
                        <a href="/course/list" class="btn btn-sm w-100 fw-bold"
                            style="color: #00b646; border: 1px solid #00b646;"
                            onmouseover="this.style.backgroundColor='#00b646'; this.style.color='#fff';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#00b646';">Gestionar
                            Cursos</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm card-custom">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-container rounded-3 text-white me-3 d-flex align-items-center justify-content-center"
                                style="background-color: #00b646; width: 45px; height: 45px;">
                                <i class="bi bi-pc-display fs-4"></i>
                            </div>
                            <h3 class="h5 card-title mb-0 fw-bold text-dark">Computadores</h3>
                        </div>
                        <p class="card-text text-secondary small mb-4">Registro técnico del inventario de cómputo y equipos
                            asignados.</p>
                        <a href="/computer/list" class="btn btn-sm w-100 fw-bold"
                            style="color: #00b646; border: 1px solid #00b646;"
                            onmouseover="this.style.backgroundColor='#00b646'; this.style.color='#fff';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#00b646';">Gestionar
                            Equipos</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm card-custom">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-container rounded-3 text-white me-3 d-flex align-items-center justify-content-center"
                                style="background-color: #00b646; width: 45px; height: 45px;">
                                <i class="bi bi-building-gear fs-4"></i>
                            </div>
                            <h3 class="h5 card-title mb-0 fw-bold text-dark">Áreas</h3>
                        </div>
                        <p class="card-text text-secondary small mb-4">Configuración de los diferentes ambientes físicos y
                            laboratorios.</p>
                        <a href="/area/list" class="btn btn-sm w-100 fw-bold"
                            style="color: #00b646; border: 1px solid #00b646;"
                            onmouseover="this.style.backgroundColor='#00b646'; this.style.color='#fff';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#00b646';">Gestionar
                            Áreas</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm card-custom">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-container rounded-3 text-white me-3 d-flex align-items-center justify-content-center"
                                style="background-color: #00b646; width: 45px; height: 45px;">
                                <i class="bi bi-geo-alt-fill fs-4"></i>
                            </div>
                            <h3 class="h5 card-title mb-0 fw-bold text-dark">Centros</h3>
                        </div>
                        <p class="card-text text-secondary small mb-4">Información general sobre las sedes y centros de
                            formación institucional.</p>
                        <a href="/training_center/list" class="btn btn-sm w-100 fw-bold"
                            style="color: #00b646; border: 1px solid #00b646;"
                            onmouseover="this.style.backgroundColor='#00b646'; this.style.color='#fff';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#00b646';">Gestionar
                            Centros</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('event.index')

    <style>

        .card-custom {
            border-left: 4px solid #019a3b !important;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-custom:hover {
            transform: translateY(-4px);
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
        }

        .tracking-wider {
            letter-spacing: 1px;
        }

        .carousel-caption {
            padding-bottom: 0;
        }
    </style>
@endsection
