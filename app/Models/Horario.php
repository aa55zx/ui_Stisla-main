<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table      = 'horario';
    protected $primaryKey = 'id_horario';

    protected $fillable = ['id_grupo', 'id_dia', 'hora_inicio', 'hora_fin'];

    public function dia()
    {
        return $this->belongsTo(DiaSemana::class, 'id_dia');
    }
}