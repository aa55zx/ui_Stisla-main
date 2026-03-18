<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table      = 'departamento';
    protected $primaryKey = 'id_departamento';

    protected $fillable = ['nombre', 'edificio'];
}