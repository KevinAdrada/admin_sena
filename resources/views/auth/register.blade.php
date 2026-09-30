@extends('layouts.auth')

@section('content')
    <div class="auth-wrapper">
        <div class="auth-container">
            <div class="split-card">
                <div class="left-side-green">
                    <div class="green-content">
                        <h2 class="fw-bold fs-2 mb-3 text-white">¡Bienvenido<br>de Nuevo!</h2>
                        <p class="mb-4" style="font-size: 1rem; line-height: 1.5; color: rgba(243, 240, 240, 0.8)">
                            Para mantenerte conectado con nosotros, por favor inicia sesión con tu información personal.
                        </p>
                        <div>
                            <a href="{{ route('login') }}" class="btn-outline-white">
                                INICIAR SESIÓN
                            </a>
                        </div>
                    </div>
                    <div class="logo-bottom">
                        <img src="{{ asset('images/logo-sena.png') }}" alt="SENA Logo"
                            style="height: 42px; filter: brightness(0) invert(1);" onerror="this.style.display='none'">
                    </div>
                </div>

                <div class="right-side-form">
                    <div class="form-box">
                        <div class="text-center mb-3">
                            <img src="{{ asset('images/logo-sena.png') }}" alt="Logo SENA" class="img-fluid logo-verde"
                                style="max-height: 55px;" onerror="this.style.display='none'">
                        </div>

                        <h3 class="fw-bold text-center mb-4 text-dark">Crea tu Cuenta</h3>

                        @if ($errors->any())
                            <div class="alert alert-danger py-2 small rounded-3 mb-3">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="input-icon-group">
                                <i class="bi bi-person"></i>
                                <input type="text" name="name" placeholder="Nombre Completo"
                                    value="{{ old('name') }}" required autofocus>
                            </div>

                            <div class="input-icon-group">
                                <i class="bi bi-card-text"></i>
                                <input type="text" name="documento" placeholder="Documento"
                                    value="{{ old('documento') }}" required>
                            </div>

                            <div class="input-icon-group">
                                <i class="bi bi-phone"></i>
                                <input type="text" name="celular" placeholder="Celular" value="{{ old('celular') }}"
                                    required>
                            </div>

                            <div class="input-icon-group">
                                <i class="bi bi-envelope"></i>
                                <input type="email" name="email" placeholder="Correo Electrónico"
                                    value="{{ old('email') }}" required>
                            </div>

                            <div class="input-icon-group">
                                <i class="bi bi-diagram-3"></i>
                                <select name="rol" id="rol-select" required>
                                    <option value="">Seleccione un rol</option>
                                    <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="instructor" {{ old('rol') == 'instructor' ? 'selected' : '' }}>
                                        Instructor</option>
                                    <option value="aprendiz" {{ old('rol') == 'aprendiz' ? 'selected' : '' }}>Aprendiz
                                    </option>
                                </select>
                            </div>

                            <div id="fields-admin" class="role-fields" style="display: none;">
                                <div class="input-icon-group">
                                    <i class="bi bi-briefcase"></i>
                                    <select name="tipo_cargo_admin">
                                        <option value="">Seleccione tipo de cargo</option>
                                        <option value="directivo"
                                            {{ old('tipo_cargo_admin') == 'directivo' ? 'selected' : '' }}>Directivo
                                        </option>
                                        <option value="subdirectivo"
                                            {{ old('tipo_cargo_admin') == 'subdirectivo' ? 'selected' : '' }}>Subdirectivo
                                        </option>
                                        <option value="coordinador"
                                            {{ old('tipo_cargo_admin') == 'coordinador' ? 'selected' : '' }}>Coordinador
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div id="fields-instructor" class="role-fields" style="display: none;">
                                <div class="form-check form-switch mb-3 ms-1">
                                    <input class="form-check-input" type="checkbox" id="es_cuentadante"
                                        name="es_cuentadante" value="1" {{ old('es_cuentadante') ? 'checked' : '' }}>
                                    <label class="form-check-label small fw-semibold text-secondary"
                                        for="es_cuentadante">¿Es Cuentadante?</label>
                                </div>
                                <div class="input-icon-group" id="wrapper-tipo-cuentadante" style="display: none;">
                                    <i class="bi bi-shield-check"></i>
                                    <select name="tipo_cuentadante" id="tipo_cuentadante">
                                        <option value="">Seleccione tipo de cuentadante</option>
                                        <option value="planta" {{ old('tipo_cuentadante') == 'planta' ? 'selected' : '' }}>
                                            Planta</option>
                                        <option value="contratista"
                                            {{ old('tipo_cuentadante') == 'contratista' ? 'selected' : '' }}>Contratista
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div id="fields-aprendiz" class="role-fields" style="display: none;">
                                <div class="input-icon-group">
                                    <i class="bi bi-journal-bookmark"></i>
                                    <select name="course_id" id="course_id">
                                        <option value="">Seleccione un curso</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}"
                                                {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                                {{ $course->course_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="input-icon-group">
                                <i class="bi bi-lock"></i>
                                <input type="password" name="password" placeholder="Contraseña" required>
                            </div>

                            <div class="input-icon-group">
                                <i class="bi bi-shield-lock"></i>
                                <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña"
                                    required>
                            </div>

                            <button type="submit" class="btn btn-sena-green mt-3">
                                REGISTRARSE
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rolSelect = document.getElementById('rol-select');
            const fieldsAdmin = document.getElementById('fields-admin');
            const fieldsTeacher = document.getElementById('fields-instructor');
            const fieldsAprendiz = document.getElementById('fields-aprendiz');

            const checkboxCuentadante = document.getElementById('es_cuentadante');
            const wrapperTipoCuentadante = document.getElementById('wrapper-tipo-cuentadante');

            function toggleRoleFields() {
                const selectedRol = rolSelect.value;

                fieldsAdmin.style.display = 'none';
                fieldsTeacher.style.display = 'none';
                fieldsAprendiz.style.display = 'none';

                if (selectedRol === 'admin') {
                    fieldsAdmin.style.display = 'block';
                } else if (selectedRol === 'instructor') {
                    fieldsTeacher.style.display = 'block';
                } else if (selectedRol === 'aprendiz') {
                    fieldsAprendiz.style.display = 'block';
                }
            }

            function toggleCuentadanteField() {
                if (checkboxCuentadante && checkboxCuentadante.checked) {
                    wrapperTipoCuentadante.style.display = 'block';
                } else {
                    wrapperTipoCuentadante.style.display = 'none';
                    const selectTipo = document.getElementById('tipo_cuentadante');
                    if (selectTipo) selectTipo.value = '';
                }
            }

            rolSelect.addEventListener('change', toggleRoleFields);
            if (checkboxCuentadante) {
                checkboxCuentadante.addEventListener('change', toggleCuentadanteField);
            }

            toggleRoleFields();
            toggleCuentadanteField();
        });
    </script>

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            background-color: #f8f9fa !important;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }

        .split-card {
            background: #ffffff;
            border-radius: 20px;
            width: 100%;
            max-width: 880px;
            min-height: 520px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: row;
            animation: fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .logo-verde {
            filter: invert(48%) sepia(85%) saturate(1468%) hue-rotate(69deg) brightness(98%) contrast(103%);
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 20px;
            box-sizing: border-box;
        }

        .auth-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .left-side-green {
            flex: 1;
            background-color: #00b646;
            color: #ffffff;
            padding: 35px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            text-align: center;
        }

        .green-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            max-width: 280px;
        }

        .right-side-form {
            flex: 1;
            padding: 35px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow-y: auto;
            max-height: 90vh;
        }

        .form-box {
            width: 100%;
            max-width: 320px;
        }

        .logo-bottom {
            padding-top: 15px;
        }

        .input-icon-group {
            position: relative;
            width: 100%;
            margin-bottom: 14px;
        }

        .input-icon-group i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #8c8c8c;
            font-size: 1.1rem;
        }

        .input-icon-group input,
        .input-icon-group select {
            width: 100%;
            background-color: #f1f3f5;
            border: 1px solid transparent;
            border-radius: 12px;
            padding: 12px 15px 12px 45px;
            font-size: 0.92rem;
            color: #333;
            outline: none;
            box-sizing: border-box;
        }

        .input-icon-group select {
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .input-icon-group input:focus,
        .input-icon-group select:focus {
            background-color: #ffffff;
            border-color: #00b646;
            box-shadow: 0 0 0 0.2rem rgba(0, 182, 70, 0.15);
        }

        .btn-sena-green {
            background-color: #00b646;
            color: #ffffff;
            border: 2px solid transparent;
            font-weight: 700;
            border-radius: 22px;
            padding: 12px;
            width: 100%;
            text-transform: uppercase;
            font-size: 0.85rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-sena-green:hover {
            background-color: #ffffff;
            color: #00b646;
            border-color: #00cb4e;
        }

        .btn-outline-white {
            border: 2px solid #ffffff;
            color: #ffffff;
            font-weight: 700;
            border-radius: 22px;
            padding: 10px 32px;
            text-transform: uppercase;
            text-decoration: none;
            font-size: 0.85rem;
            display: inline-block;
            transition: all 0.2s ease;
        }

        .btn-outline-white:hover {
            background-color: #ffffff;
            color: #39a900;
            box-shadow: #d8f3e2 0px 4px 10px;
        }

        @media (max-width: 768px) {
            .split-card {
                flex-direction: column-reverse;
                min-height: auto;
            }

            .left-side-green {
                padding: 40px 20px;
            }

            .right-side-form {
                padding: 30px 20px;
            }
        }
    </style>
@endsection
