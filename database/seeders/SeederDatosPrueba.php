<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederDatosPrueba extends Seeder
{
    public function run(): void
    {
        // Carreras
        DB::table('carrera')->insert([
            ['nombre' => 'Ingeniería en Sistemas Computacionales'],
            ['nombre' => 'Ingeniería Industrial'],
            ['nombre' => 'Ingeniería en Gestión Empresarial'],
            ['nombre' => 'Ingeniería Mecatrónica'],
        ]);

        // Departamentos
        DB::table('departamento')->insert([
            ['nombre' => 'Ciencias Básicas', 'edificio' => 'Edificio A'],
            ['nombre' => 'Sistemas y Computación', 'edificio' => 'Edificio B'],
            ['nombre' => 'Ciencias Económico Administrativas', 'edificio' => 'Edificio C'],
            ['nombre' => 'Cultura Física', 'edificio' => 'Gimnasio'],
        ]);

        // Días de la semana
        DB::table('dia_semana')->insert([
            ['nombre_dia' => 'lunes'],
            ['nombre_dia' => 'martes'],
            ['nombre_dia' => 'miercoles'],
            ['nombre_dia' => 'jueves'],
            ['nombre_dia' => 'viernes'],
            ['nombre_dia' => 'sabado'],
        ]);

        // Ubicaciones
        DB::table('ubicacion')->insert([
            ['espacio' => 'Aula 101', 'capacidad' => 30],
            ['espacio' => 'Aula 202', 'capacidad' => 25],
            ['espacio' => 'Gimnasio', 'capacidad' => 50],
            ['espacio' => 'Sala de Cómputo 1', 'capacidad' => 20],
            ['espacio' => 'Virtual', 'capacidad' => 100],
        ]);

        // Semestre activo
        DB::table('semestre')->insert([
            [
                'año'                        => 2026,
                'periodo'                    => 1,
                'fecha_inicio'               => '2026-01-15',
                'fecha_fin'                  => '2026-06-15',
                'fecha_inicio_inscripciones' => '2026-01-01',
                'fecha_fin_inscripciones'    => '2026-02-01',
            ],
        ]);

        // Actividades complementarias
        DB::table('actividad_complementaria')->insert([
            [
                'nombre'          => 'Programación Web con Laravel',
                'descripcion'     => 'Aprende a desarrollar aplicaciones web modernas usando el framework Laravel de PHP.',
                'id_categoria'    => null,
                'id_departamento' => 2,
                'requisitos'      => 'Conocimientos básicos de PHP y HTML',
                'nivel_actividad' => 'Intermedio',
                'disponible'      => true,
                'creditos'        => 2,
            ],
            [
                'nombre'          => 'Inglés Técnico',
                'descripcion'     => 'Curso de inglés enfocado en vocabulario técnico para ingenieros.',
                'id_categoria'    => null,
                'id_departamento' => 1,
                'requisitos'      => 'Ninguno',
                'nivel_actividad' => 'Básico',
                'disponible'      => true,
                'creditos'        => 1,
            ],
            [
                'nombre'          => 'Fútbol Soccer',
                'descripcion'     => 'Actividad deportiva de fútbol soccer para el desarrollo físico y trabajo en equipo.',
                'id_categoria'    => null,
                'id_departamento' => 4,
                'requisitos'      => 'Ninguno',
                'nivel_actividad' => 'Básico',
                'disponible'      => true,
                'creditos'        => 1,
            ],
            [
                'nombre'          => 'Emprendimiento e Innovación',
                'descripcion'     => 'Desarrolla habilidades para crear y gestionar tu propio negocio.',
                'id_categoria'    => null,
                'id_departamento' => 3,
                'requisitos'      => 'Ninguno',
                'nivel_actividad' => 'Básico',
                'disponible'      => true,
                'creditos'        => 2,
            ],
            [
                'nombre'          => 'Diseño Gráfico Digital',
                'descripcion'     => 'Aprende herramientas de diseño gráfico para crear contenido visual profesional.',
                'id_categoria'    => null,
                'id_departamento' => 2,
                'requisitos'      => 'Ninguno',
                'nivel_actividad' => 'Básico',
                'disponible'      => true,
                'creditos'        => 1,
            ],
        ]);

        // Actividad-Carrera (todas las carreras pueden acceder a todas las actividades)
        foreach (range(1, 5) as $actividad) {
            foreach (range(1, 4) as $carrera) {
                DB::table('ACTIVIDAD_CARRERA')->insert([
                    'id_actividad' => $actividad,
                    'id_carrera'   => $carrera,
                ]);
            }
        }

        // Grupos
        DB::table('grupo')->insert([
            [
                'id_actividad'        => 1,
                'id_semestre'         => 1,
                'id_instructor'       => null,
                'id_ubicacion'        => 4,
                'grupo'               => 'A',
                'cupo_maximo'         => 20,
                'cupo_ocupado'        => 5,
                'modalidad'           => 'presencial',
                'materiales_requeridos' => 'Laptop',
                'estatus'             => 'abierta',
                'fecha_inicio'        => '2026-02-01',
                'fecha_fin'           => '2026-05-31',
            ],
            [
                'id_actividad'        => 2,
                'id_semestre'         => 1,
                'id_instructor'       => null,
                'id_ubicacion'        => 1,
                'grupo'               => 'A',
                'cupo_maximo'         => 25,
                'cupo_ocupado'        => 10,
                'modalidad'           => 'presencial',
                'materiales_requeridos' => 'Ninguno',
                'estatus'             => 'abierta',
                'fecha_inicio'        => '2026-02-01',
                'fecha_fin'           => '2026-05-31',
            ],
            [
                'id_actividad'        => 3,
                'id_semestre'         => 1,
                'id_instructor'       => null,
                'id_ubicacion'        => 3,
                'grupo'               => 'A',
                'cupo_maximo'         => 30,
                'cupo_ocupado'        => 15,
                'modalidad'           => 'presencial',
                'materiales_requeridos' => 'Ropa deportiva',
                'estatus'             => 'abierta',
                'fecha_inicio'        => '2026-02-01',
                'fecha_fin'           => '2026-05-31',
            ],
        ]);

        // Horarios
        DB::table('horario')->insert([
            ['id_grupo' => 1, 'id_dia' => 1, 'hora_inicio' => '10:00:00', 'hora_fin' => '12:00:00'],
            ['id_grupo' => 1, 'id_dia' => 3, 'hora_inicio' => '10:00:00', 'hora_fin' => '12:00:00'],
            ['id_grupo' => 2, 'id_dia' => 2, 'hora_inicio' => '08:00:00', 'hora_fin' => '10:00:00'],
            ['id_grupo' => 2, 'id_dia' => 4, 'hora_inicio' => '08:00:00', 'hora_fin' => '10:00:00'],
            ['id_grupo' => 3, 'id_dia' => 5, 'hora_inicio' => '14:00:00', 'hora_fin' => '16:00:00'],
        ]);
    }
}