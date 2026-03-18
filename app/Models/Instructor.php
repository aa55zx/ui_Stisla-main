<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $table      = 'instructor';
    protected $primaryKey = 'id_instructor';

    protected $fillable = ['id_departamento', 'especialidad'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_instructor');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento');
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'id_instructor');
    }
}