<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #00b646;" data-bs-theme="light">
    <!-- Usamos container-fluid para abarcar todo el ancho de la pantalla -->
    <div class="container-fluid px-3 px-md-4">
        
        <!-- Logo y Título -->
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('images/logo-sena.png') }}" alt="logo Sena" class="img-fluid"
                style="width: 40px; height: 40px; margin-right: 10px;">
            <span class="fw-bold fs-5 text-white tracking-wide">Admin Sena</span>
        </a>

        <!-- Botón Hamburguesa para Móviles -->
        <button class="navbar-toggler border-0 text-white shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-underline navbar-dark ms-auto mb-2 mb-lg-0 gap-2 align-items-lg-center">
                
                <!-- Enlace Quiénes Somos -->
                <li class="nav-item">
                    <a class="nav-link text-white px-3 py-2 fw-semibold" href="/about">¿Quiénes Somos?</a>
                </li>

                <!-- Invitados (Guest) -->
                @guest
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a href="{{ route('login') }}"
                            class="btn btn-outline-light btn-sm fw-bold d-inline-flex align-items-center px-3 py-2 shadow-sm"
                            style="border-width: 2px; border-radius: 1rem;">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar Sesión
                        </a>
                    </li>
                @endguest

                <!-- Autenticados (Auth) -->
                @auth
                    <!-- Menú de Administración -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white px-3 py-2 fw-semibold" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-speedometer2 me-1"></i> Administración
                        </a>
                        <ul class="dropdown-menu border-0 shadow-lg p-2 mt-2"
                            style="border-radius: 0.75rem; --bs-dropdown-link-active-bg: #00b646; --bs-dropdown-link-hover-bg: #f8f9fa; --bs-dropdown-link-hover-color: #00b646;">
                            <li><a class="dropdown-item py-2 px-3 rounded-2 fw-medium" href="/training_center/list"><i class="bi bi-building me-2 text-success"></i>Centro de Formación</a></li>
                            <li><a class="dropdown-item py-2 px-3 rounded-2 fw-medium" href="/environment/list"><i class="bi bi-door-open me-2 text-success"></i>Ambientes</a></li>
                            <li><a class="dropdown-item py-2 px-3 rounded-2 fw-medium" href="/user/list"><i class="bi bi-people me-2 text-success"></i>Usuarios</a></li>
                            <li><a class="dropdown-item py-2 px-3 rounded-2 fw-medium" href="/admin/list"><i class="bi bi-shield-check me-2 text-success"></i>Administradores</a></li>
                            <li><a class="dropdown-item py-2 px-3 rounded-2 fw-medium" href="/teacher/list"><i class="bi bi-person-badge me-2 text-success"></i>Instructores</a></li>
                            <li><a class="dropdown-item py-2 px-3 rounded-2 fw-medium" href="/apprentice/list"><i class="bi bi-mortarboard me-2 text-success"></i>Aprendices</a></li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li><a class="dropdown-item py-2 px-3 rounded-2 fw-medium" href="/area/list"><i class="bi bi-grid me-2 text-success"></i>Áreas</a></li>
                            <li><a class="dropdown-item py-2 px-3 rounded-2 fw-medium" href="/course/list"><i class="bi bi-journal-text me-2 text-success"></i>Cursos</a></li>
                            <li><a class="dropdown-item py-2 px-3 rounded-2 fw-medium" href="/computer/list"><i class="bi bi-pc-display me-2 text-success"></i>Equipos</a></li>
                        </ul>
                    </li>

                    <!-- Menú de Usuario / Perfil -->
                    <li class="nav-item dropdown ms-lg-2 mt-3 mt-lg-0">
                        <a class="nav-link p-0 d-flex align-items-center" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" title="{{ Auth::user()->name }}">
                            <div class="rounded-circle bg-white text-success fw-bold d-flex align-items-center justify-content-center shadow-sm"
                                style="width: 40px; height: 40px; font-size: 1rem; cursor: pointer; border: 2px solid rgba(255,255,255,0.8);">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-3 mt-2" style="border-radius: 0.75rem; min-width: 240px;">
                            <li>
                                <div class="dropdown-item-text fw-bold text-dark px-0 pb-1 text-truncate">
                                    {{ Auth::user()->name }}
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-item-text text-muted small px-0 pt-0 text-truncate">
                                    {{ Auth::user()->email }}
                                </div>
                            </li>
                            <li>
                                <hr class="dropdown-divider my-2">
                            </li>
                            <li>
                                <a class="dropdown-item py-2 px-3 rounded-2 fw-medium text-dark d-flex align-items-center" href="/profile">
                                    <i class="bi bi-person me-2 text-success"></i> Mi Perfil
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0 mt-1">
                                    @csrf
                                    <button type="submit"
                                        class="dropdown-item py-2 px-3 rounded-2 text-danger fw-semibold d-flex align-items-center">
                                        <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>