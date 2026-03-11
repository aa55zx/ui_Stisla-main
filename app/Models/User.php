<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    // Tabla real en la BD
    protected $table = 'USUARIO';

    // Clave primaria personalizada
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'contraseña',
        'tipo_usuario',
        'num_control',
        'telefono',
        'ultimo_acceso',
    ];

    protected $hidden = [
        'contraseña',
        'remember_token',
    ];

    protected $casts = [
        'ultimo_acceso' => 'datetime',
    ];

    // Laravel usa este método para obtener la contraseña al autenticar
    public function getAuthPassword()
    {
        return $this->contraseña;
    }

    // Atributo helper: nombre completo
    public function getNombreCompletoAttribute(): string
    {
        return trim("{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}");
    }
}
