<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActividadComplementaria;

class ActividadComplementariaController extends Controller
{
    public function index()
    {
        $actividades = ActividadComplementaria::with(['departamento', 'grupos', 'carreras'])
            ->where('disponible', true)
            ->paginate(9);
        return view('actividades.index', compact('actividades'));
    }

    public function show($id)
    {
        $actividad = ActividadComplementaria::with([
            'departamento',
            'carreras',
            'grupos.instructor.usuario',
            'grupos.ubicacion',
            'grupos.horarios.dia',
        ])->findOrFail($id);

        return view('actividades.show', compact('actividad'));
    }

    public function create() {}
    public function store(Request $request) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}