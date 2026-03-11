<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Redirigir según tipo_usuario después del login
    protected function authenticated(Request $request, $user)
    {
        // Actualizar último acceso
        $user->update(['ultimo_acceso' => now()]);

        return match ($user->tipo_usuario) {
            'admin'      => redirect()->route('admin.dashboard'),
            'instructor' => redirect()->route('instructor.dashboard'),
            default      => redirect()->route('alumno.dashboard'),
        };
    }
}
