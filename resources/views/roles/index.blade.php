@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Roles</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Listado de Roles</h4>
                        @can('crear-rol')
                        <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i> Nuevo Rol
                        </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Permisos</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($roles as $rol)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $rol->name }}</td>
                                        <td>
                                            @foreach ($rol->permissions as $permiso)
                                                <span class="badge badge-info">{{ $permiso->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('editar-rol')
                                            <a href="{{ route('roles.edit', $rol->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i> Editar
                                            </a>
                                            @endcan
                                            @can('borrar-rol')
                                            <form action="{{ route('roles.destroy', $rol->id) }}" method="POST" style="display:inline-block"
                                                onsubmit="return confirm('¿Eliminar este rol?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No hay roles registrados.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- Paginación --}}
                        {!! $roles->links() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection