<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('usuarios.crear', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre'           => 'required',
            'apellido_paterno' => 'required',
            'email'            => 'required|email|unique:USUARIO,email',
            'password'         => 'required|same:confirm-password',
            'roles'            => 'required',
            'num_control'      => 'required|numeric',
            'tipo_usuario'     => 'required',
        ]);

        $user = User::create([
            'nombre'           => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'email'            => $request->email,
            'contrasena'       => Hash::make($request->password),
            'tipo_usuario'     => $request->tipo_usuario,
            'num_control'      => $request->num_control,
            'telefono'         => $request->telefono,
        ]);

        $userCreado = User::where('email', $request->email)->first();
app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
try {
    $userCreado->assignRole($request->input('roles'));
} catch (\Exception $e) {
    \Log::error('assignRole error: ' . $e->getMessage());
}

        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario creado correctamente.');
    }

    public function show($id) {}

    public function edit($id)
    {
        $user     = User::findOrFail($id);
        $roles    = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('usuarios.editar', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre'           => 'required',
            'apellido_paterno' => 'required',
            'email'            => 'required|email|unique:USUARIO,email,' . $id,
            'password'         => 'nullable|same:confirm-password',
            'roles'            => 'required',
        ]);

        $user = User::findOrFail($id);

        $data = [
            'nombre'           => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'email'            => $request->email,
            'tipo_usuario'     => $request->tipo_usuario,
            'num_control'      => $request->num_control,
            'telefono'         => $request->telefono,
        ];

        if (!empty($request->password)) {
            $data['contrasena'] = Hash::make($request->password);
        }

        $user->update($data);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->fresh()->assignRole($request->input('roles'));

        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario eliminado correctamente.');
    }
}