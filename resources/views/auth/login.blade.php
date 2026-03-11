@extends('layouts.auth_app')
@section('title')
    Iniciar Sesión
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Iniciar Sesión</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger p-0">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input id="email" type="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email"
                           placeholder="tucorreo@ejemplo.com"
                           value="{{ old('email') }}"
                           tabindex="1" autofocus required>
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Contraseña</label>
                        <div class="float-right">
                            <a href="{{ route('password.request') }}" class="text-small">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>
                    </div>
                    <input id="password" type="password"
                           placeholder="••••••••"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input"
                               tabindex="3" id="remember">
                        <label class="custom-control-label" for="remember">Recordarme</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Ingresar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-5 text-muted text-center">
        ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
    </div>
@endsection
