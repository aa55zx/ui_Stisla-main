@extends('layouts.auth_app')
@section('title')
    Registro de Usuario
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Crear Cuenta</h4>
        </div>

        <div class="card-body pt-1">
            <form method="POST" action="{{ route('register') }}">
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

                <div class="row">

                    {{-- Tipo de usuario --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tipo de Usuario <span class="text-danger">*</span></label>
                            <select name="tipo_usuario"
                                    class="form-control{{ $errors->has('tipo_usuario') ? ' is-invalid' : '' }}">
                                <option value="">-- Selecciona --</option>
                                <option value="alumno"     {{ old('tipo_usuario') == 'alumno'     ? 'selected' : '' }}>Alumno</option>
                                <option value="instructor" {{ old('tipo_usuario') == 'instructor' ? 'selected' : '' }}>Instructor</option>
                                <option value="admin"      {{ old('tipo_usuario') == 'admin'      ? 'selected' : '' }}>Administrador</option>
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('tipo_usuario') }}</div>
                        </div>
                    </div>

                    {{-- Nombre --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nombre(s) <span class="text-danger">*</span></label>
                            <input type="text" name="nombre"
                                   class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}"
                                   value="{{ old('nombre') }}" placeholder="Ej. Juan Carlos" required>
                            <div class="invalid-feedback">{{ $errors->first('nombre') }}</div>
                        </div>
                    </div>

                    {{-- Apellidos --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Apellido Paterno <span class="text-danger">*</span></label>
                            <input type="text" name="apellido_paterno"
                                   class="form-control{{ $errors->has('apellido_paterno') ? ' is-invalid' : '' }}"
                                   value="{{ old('apellido_paterno') }}" placeholder="Ej. García" required>
                            <div class="invalid-feedback">{{ $errors->first('apellido_paterno') }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Apellido Materno</label>
                            <input type="text" name="apellido_materno"
                                   class="form-control{{ $errors->has('apellido_materno') ? ' is-invalid' : '' }}"
                                   value="{{ old('apellido_materno') }}" placeholder="Ej. López">
                            <div class="invalid-feedback">{{ $errors->first('apellido_materno') }}</div>
                        </div>
                    </div>

                    {{-- Correo --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Correo Electrónico <span class="text-danger">*</span></label>
                            <input type="email" name="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   value="{{ old('email') }}" placeholder="tucorreo@ejemplo.com" required>
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                        </div>
                    </div>

                    {{-- Número de control --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Número de Control</label>
                            <input type="number" name="num_control"
                                   class="form-control{{ $errors->has('num_control') ? ' is-invalid' : '' }}"
                                   value="{{ old('num_control') }}" placeholder="Ej. 20310001">
                            <div class="invalid-feedback">{{ $errors->first('num_control') }}</div>
                        </div>
                    </div>

                    {{-- Teléfono --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="text" name="telefono"
                                   class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}"
                                   value="{{ old('telefono') }}" placeholder="Ej. 9511234567">
                            <div class="invalid-feedback">{{ $errors->first('telefono') }}</div>
                        </div>
                    </div>

                    {{-- Contraseña --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Contraseña <span class="text-danger">*</span></label>
                            <input type="password" name="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   placeholder="Mínimo 6 caracteres" required>
                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Confirmar Contraseña <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation"
                                   class="form-control"
                                   placeholder="Repite tu contraseña" required>
                        </div>
                    </div>

                    <div class="col-md-12 mt-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Crear Cuenta
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="mt-5 text-muted text-center">
        ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
    </div>
@endsection
