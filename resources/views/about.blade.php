@extends('layouts.app')

@section('content')
    <div class="container mt-5" style="margin-bottom:100px">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">
                
                <h2 class="text-center fw-bold text-dark mb-4 position-relative pb-2">
                    ¿Quiénes Somos?
                    <span class="position-absolute bottom-0 start-50 translate-middle-x bg-success" style="width: 50px; height: 3px; border-radius: 2px;"></span>
                </h2>
                <h5 class="text-center text-muted text-uppercase tracking-widest" >Admin SENA</h5>
                <p class="text-center text-muted mb-5 small text-uppercase tracking-widest">SENA • Servicio Nacional de Aprendizaje</p>

                <div class="card shadow-sm border-0 mb-4 card-custom">
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-container rounded-3 text-white me-3 d-flex align-items-center justify-content-center" style="background-color: #39a900; width: 50px; height: 50px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-compass-fill" viewBox="0 0 16 16">
                                    <path d="M15.5 8a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0zm-8 3.5a.5.5 0 0 0 .832.374l4.5-4a.5.5 0 0 0 0-.748l-4.5-4A.5.5 0 0 0 7.5 3.5V11z"/>
                                </svg>
                            </div>
                            <h3 class="h4 card-title mb-0 fw-bold text-dark border-bottom pb-1" style="border-color: #dee2e6!important;">
                                Misión del SENA
                            </h3>
                        </div>
                        <p class="card-text text-secondary lh-lg fs-6" style="text-align: justify;">
                            El SENA está encargado de cumplir la función que le corresponde al Estado de invertir en el desarrollo social y técnico de los trabajadores colombianos, ofreciendo y executing la formación profesional integral, para la incorporación y el desarrollo de las personas en actividades productivas que contribuyan al desarrollo social, económico y tecnológico del país.
                        </p>
                    </div>
                </div>

                <div class="card shadow-sm border-0 mb-5 card-custom">
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-container rounded-3 text-white me-3 d-flex align-items-center justify-content-center" style="background-color: #39a900; width: 50px; height: 50px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                </svg>
                            </div>
                            <h3 class="h4 card-title mb-0 fw-bold text-dark border-bottom pb-1" style="border-color: #dee2e6!important;">
                                Visión del SENA
                            </h3>
                        </div>
                        <p class="card-text text-secondary lh-lg fs-6" style="text-align: justify;">
                            A 2026 el SENA será instituido como una comunidad de conocimiento, referente en formación profesional integral de alta calidad, pertinente en la empleabilidad y en la contribución a la productividad de las empresas, con impacto directo en el desarrollo social y económico del país, con una infraestructura tecnológica de vanguardia.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .card-custom {
            border-left: 5px solid #019a3b !important;
            transition: all 0.2s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .card-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0. 75rem 2rem rgba(0,0,0,.06)!important;
            border-left: 2px solid #55ff00 !important;
        }
        .tracking-wider {
            letter-spacing: 1px;
        }
        .tracking-widest {
            letter-spacing: 2px;
        }
        .carousel-caption {
            padding-bottom: 0;
        }
    </style>
@endsection