<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected function redirectTo()
    {
        return match (auth()->user()->tipo_usuario) {
            'admin'      => route('admin.dashboard'),
            'instructor' => route('instructor.dashboard'),
            default      => route('alumno.dashboard'),
        };
    }

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre'           => ['required', 'string', 'max:100'],
            'apellido_paterno' => ['required', 'string', 'max:100'],
            'apellido_materno' => ['nullable', 'string', 'max:100'],
            'email'            => ['required', 'string', 'email', 'max:100', 'unique:USUARIO,email'],
            'num_control'      => ['nullable', 'integer'],
            'telefono'         => ['nullable', 'string', 'max:20'],
            'tipo_usuario'     => ['required', 'in:alumno,instructor,admin'],
            'password'         => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'nombre.required'           => 'El nombre es obligatorio.',
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'email.required'            => 'El correo es obligatorio.',
            'email.unique'              => 'Este correo ya esta registrado.',
            'tipo_usuario.required'     => 'Selecciona un tipo de usuario.',
            'password.required'         => 'La contrasena es obligatoria.',
            'password.confirmed'        => 'Las contrasenas no coinciden.',
            'password.min'              => 'La contrasena debe tener al menos 6 caracteres.',
        ]);
    }

    protected function create(array $data)
{
    $user = User::create([
        'nombre'           => $data['nombre'],
        'apellido_paterno' => $data['apellido_paterno'],
        'apellido_materno' => $data['apellido_materno'] ?? null,
        'email'            => $data['email'],
        'contrasena'       => Hash::make($data['password']),
        'tipo_usuario'     => $data['tipo_usuario'],
        'num_control'      => $data['num_control'] ?? null,
        'telefono'         => $data['telefono'] ?? null,
        'ultimo_acceso'    => now(),
    ]);

    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    $user->assignRole($data['tipo_usuario']);

    return $user;
}

    
}