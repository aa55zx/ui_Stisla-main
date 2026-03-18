<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table      = 'inscripcion';
    protected $primaryKey = 'id_inscripcion';

    protected $fillable = [
        'id_alumno', 'id_grupo', 'fecha_inscripcion', 'estatus',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'id_alumno');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, 'id_inscripcion');
    }
}