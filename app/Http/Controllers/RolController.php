<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) abort(403);
        $roles = Role::paginate(5);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        if (!auth()->user()->hasRole('admin')) abort(403);
        $permission = Permission::get();
        return view('roles.crear', compact('permission'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) abort(403);
        $this->validate($request, [
            'name'       => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')
                         ->with('success', 'Rol creado correctamente.');
    }

    public function show($id) {}

    public function edit($id)
    {
        if (!auth()->user()->hasRole('admin')) abort(403);
        $role           = Role::find($id);
        $permission     = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_id', $id)
            ->pluck('permission_id', 'permission_id')
            ->all();
        return view('roles.editar', compact('role', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasRole('admin')) abort(403);
        $this->validate($request, [
            'name'       => 'required',
            'permission' => 'required',
        ]);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')
                         ->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy($id)
    {
        if (!auth()->user()->hasRole('admin')) abort(403);
        DB::table('roles')->where('id', $id)->delete();
        return redirect()->route('roles.index')
                         ->with('success', 'Rol eliminado correctamente.');
    }
}