@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Roles</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Crear Nuevo Rol</h4>
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

                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label>Nombre del Rol</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name') }}" placeholder="Ej: alumno, instructor" required>
                            </div>

                            <div class="form-group">
                                <label>Permisos</label>
                                <div class="row">
                                    @foreach ($permission as $perm)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                name="permission[]"
                                                value="{{ $perm->name }}"
                                                id="perm_{{ $perm->id }}"
                                                {{ in_array($perm->name, old('permission', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="perm_{{ $perm->id }}">
                                                {{ $perm->name }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Guardar
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