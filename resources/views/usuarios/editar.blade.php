@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Usuarios</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">

                <div class="card">
                    <div class="card-header">
                        <h4>Editar Usuario</h4>
                    </div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('usuarios.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Nombre completo</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label>Correo electrónico</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="form-group">
                                <label>Nueva contraseña <small class="text-muted">(dejar vacío para no cambiar)</small></label>
                                <input type="password" name="password" class="form-control" placeholder="Nueva contraseña">
                            </div>

                            <div class="form-group">
                                <label>Confirmar nueva contraseña</label>
                                <input type="password" name="confirm-password" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Rol</label>
                                <select name="roles" class="form-control" required>
                                    <option value="">-- Selecciona un rol --</option>
                                    @foreach ($roles as $rol)
                                        <option value="{{ $rol }}" {{ isset($userRole[$rol]) ? 'selected' : '' }}>
                                            {{ $rol }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Actualizar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection