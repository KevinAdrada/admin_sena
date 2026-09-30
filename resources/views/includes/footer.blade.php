<footer class="bg-dark text-white pt-5 pb-4 mt-5 border-top border-4" style="border-color: #00b646 !important;">
    <div class="container">
        <div class="row g-4 mb-4">
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-2"
                        style="background-color: #00b646; width: 40px; height: 40px;">
                        <i class="bi bi-shield-check text-white fs-4"></i>
                    </div>
                    <span class="fs-4 fw-bold text-white tracking-wider">SENA <span
                            style="color: #00b646;">Admin</span></span>
                </div>
                <p class="text-secondary small mb-3">
                    Plataforma institucional para la gestión, control y seguimiento de procesos académicos, ambientes de
                    formación y comunidad educativa.
                </p>
                <div class="d-flex gap-2">
                    <a href="#"
                        class="btn btn-sm btn-outline-light rounded-circle d-flex align-items-center justify-content-center btn-social"
                        style="width: 36px; height: 36px;">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#"
                        class="btn btn-sm btn-outline-light rounded-circle d-flex align-items-center justify-content-center btn-social"
                        style="width: 36px; height: 36px;">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#"
                        class="btn btn-sm btn-outline-light rounded-circle d-flex align-items-center justify-content-center btn-social"
                        style="width: 36px; height: 36px;">
                        <i class="bi bi-youtube"></i>
                    </a>
                </div>
            </div>

            <!-- Columna 2: Enlaces Rápidos -->
            <div class="col-lg-2 col-md-6">
                <h5
                    class="fw-bold mb-3 text-uppercase fs-6 pb-2 position-relative border-bottom border-2 border-secondary">
                    Enlaces
                    <span class="position-absolute bottom-0 start-0"
                        style="background-color: #00b646; width: 30px; height: 2px;"></span>
                </h5>
                <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
                    <li><a href="/#home" class="footer-link text-secondary text-decoration-none"><i
                                class="bi bi-chevron-right me-1" style="color: #00b646;"></i> Inicio</a></li>
                    <li><a href="/#eventos" class="footer-link text-secondary text-decoration-none"><i
                                class="bi bi-chevron-right me-1" style="color: #00b646;"></i> Eventos</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h5
                    class="fw-bold mb-3 text-uppercase fs-6 pb-2 position-relative border-bottom border-2 border-secondary">
                    Módulos
                    <span class="position-absolute bottom-0 start-0"
                        style="background-color: #00b646; width: 30px; height: 2px;"></span>
                </h5>
                <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
                    <li><a href="/apprentice/list" class="footer-link text-secondary text-decoration-none"><i
                                class="bi bi-chevron-right me-1" style="color: #00b646;"></i> Aprendices</a></li>
                    <li><a href="/teacher/list" class="footer-link text-secondary text-decoration-none"><i
                                class="bi bi-chevron-right me-1" style="color: #00b646;"></i> Instructores</a></li>
                    <li><a href="/course/list" class="footer-link text-secondary text-decoration-none"><i
                                class="bi bi-chevron-right me-1" style="color: #00b646;"></i> Cursos y Programas</a>
                    </li>
                    <li><a href="/computer/list" class="footer-link text-secondary text-decoration-none"><i
                                class="bi bi-chevron-right me-1" style="color: #00b646;"></i> Equipos de Cómputo</a>
                    </li>
                </ul>
            </div>

            <!-- Columna 4: Contacto / Sede -->
            <div class="col-lg-3 col-md-6">
                <h5
                    class="fw-bold mb-3 text-uppercase fs-6 pb-2 position-relative border-bottom border-2 border-secondary">
                    Contacto
                    <span class="position-absolute bottom-0 start-0"
                        style="background-color: #00b646; width: 30px; height: 2px;"></span>
                </h5>
                <ul class="list-unstyled small d-flex flex-column gap-2 mb-0 text-secondary">
                    <li class="d-flex align-items-start gap-2">
                        <i class="bi bi-geo-alt-fill mt-1" style="color: #00b646;"></i>
                        <span>Sena Sede Centro, Popayán - Cauca</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-telephone-fill" style="color: #00b646;"></i>
                        <span>01 8000 910270</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-envelope-fill" style="color: #00b646;"></i>
                        <span>soporte@sena.edu.co</span>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="border-secondary opacity-25 my-4" />

        <!-- Copyright y Legales -->
        <div class="row align-items-center small text-secondary">
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                &copy; {{ date('Y') }} <strong class="text-white">SENA</strong> — Servicio Nacional de Aprendizaje.
                Todos los derechos reservados.
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="text-secondary text-decoration-none me-3 footer-sublink">Políticas de
                    Privacidad</a>
                <a href="#" class="text-secondary text-decoration-none footer-sublink">Términos de Uso</a>
            </div>
        </div>
    </div>

    <button id="btnVolverArriba" class="btn-scroll-top" title="Volver al inicio" aria-label="Volver arriba">
        ↑
    </button>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnVolverArriba = document.getElementById('btnVolverArriba');

            if (btnVolverArriba) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 300) {
                        btnVolverArriba.classList.add('show');
                    } else {
                        btnVolverArriba.classList.remove('show');
                    }
                });

                btnVolverArriba.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        });
    </script>
</footer>



<style>
    .btn-scroll-top {
            margin-bottom: 25px;
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1050;
            width: 50px;
            height: 50px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            outline: none;
            background-color: rgba(56, 169, 0, 0.55);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            color: #ffffff;
            cursor: pointer;
            border-radius: 50%;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px) scale(0.9);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-scroll-top:hover {
            background-color: rgba(63, 187, 1, 0.85);
            transform: translateY(-3px) scale(1.08);
            box-shadow: 0px 12px 25px rgba(0, 0, 0, 0.3);
        }

        .btn-scroll-top.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }


    /* Efectos Hover para Enlaces del Footer */
    .footer-link {
        transition: color 0.2s ease-in-out, transform 0.2s ease-in-out;
        display: inline-block;
    }

    .footer-link:hover {
        color: #00b646 !important;
        transform: translateX(4px);
    }

    .footer-sublink:hover {
        color: #00b646 !important;
    }

    .btn-social {
        transition: all 0.2s ease-in-out;
    }

    html {
        scroll-behavior: smooth;
    }

    .btn-social:hover {
        background-color: #00b646 !important;
        border-color: #00b646 !important;
        color: #ffffff !important;
        transform: translateY(-3px);
    }
</style>
