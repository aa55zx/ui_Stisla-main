<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiaSemana extends Model
{
    protected $table      = 'dia_semana';
    protected $primaryKey = 'id_dia';

    protected $fillable = ['nombre_dia'];
}