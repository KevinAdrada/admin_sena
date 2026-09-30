@extends('layouts.auth')

@section('content')
    <div class="auth-wrapper">
        <div class="auth-container">
            <div class="split-card">

                <div class="left-side">
                    <div class="form-box">

                        <div class="text-center mb-3">
                            <img src="{{ asset('images/logo-sena.png') }}" alt="Logo SENA" class="img-fluid logo-verde"
                                style="max-height: 70px;" onerror="this.style.display='none'">
                        </div>

                        <h2 class="fw-bold text-center mb-4 text-dark">Inicia Sesión</h2>

                        @if (session('success'))
                            <div class="alert alert-success py-2 small text-center rounded-3">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger py-2 small rounded-3">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="input-icon-group">
                                <i class="bi bi-envelope"></i>
                                <input type="email" name="email" placeholder="Correo Electrónico"
                                    value="{{ old('email') }}" required autofocus>
                            </div>
                            <div class="input-icon-group">
                                <i class="bi bi-lock"></i>
                                <input type="password" name="password" placeholder="Contraseña" required>
                            </div>
                            <div class="text-center my-3">
                                <a href="#" class="text-decoration-none small text-muted">¿Olvidaste tu
                                    contraseña?</a>
                            </div>
                            <button type="submit" class="btn btn-sena-green">
                                INICIAR SESIÓN
                            </button>
                        </form>
                    </div>
                </div>

                <div class="right-side">
                    <div class="right-content">
                        <h2 class="fw-bold fs-1 mb-3 text-white">¡Bienvenido a<br>Admin Sena!</h2>
                        <p class="mb-4" style="font-size: 0.95rem; line-height: 1.4; color: rgba(255, 255, 255, 0.8);">
                            Ingresa tus datos personales y comienza tu jornada con nosotros.
                        </p>
                        <div>
                            <a href="{{ route('register') }}" class="btn-outline-white">
                                REGISTRARSE
                            </a>
                        </div>
                    </div>
                    <div class="logo-bottom">
                        <img src="{{ asset('images/logo-sena.png') }}" alt="SENA Logo" style="height: 45px;"
                            onerror="this.style.display='none'">
                    </div>

                </div>

            </div>
        </div>

    </div>

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
        }

        .left-side {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .form-box {
            width: 100%;
            max-width: 320px;
        }

        .right-side {
            flex: 1;
            background-color: #00b646;
            color: #ffffff;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            text-align: center;
        }

        .right-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            max-width: 300px;
        }

        .logo-bottom {
            padding-top: 15px;
        }

        .input-icon-group {
            position: relative;
            width: 100%;
            margin-bottom: 15px;
        }

        .input-icon-group i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #8c8c8c;
            font-size: 1.1rem;
        }

        .input-icon-group input {
            width: 100%;
            background-color: #f1f3f5;
            border: 1px solid transparent;
            border-radius: 12px;
            padding: 12px 15px 12px 45px;
            font-size: 0.95rem;
            color: #333;
            outline: none;
            box-sizing: border-box;
        }

        .input-icon-group input:focus {
            background-color: #ffffff;
            border-color: #00b646;
            box-shadow: 0 0 0 0.2rem rgba(57, 169, 0, 0.15);
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
            transition: background-color 0.2s ease;
        }

        .btn-sena-green:hover {
            background-color: #ffffff;
            color: #00b646;
            border-color: #00b646;
        }

        .btn-outline-white {
            border: 2px solid #ffffff;
            color: #ffffff;
            font-weight: 700;
            border-radius: 25px;
            padding: 10px 35px;
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
                flex-direction: column;
            }

            .right-side {
                padding: 50px 20px;
            }
        }
    </style>
@endsection
