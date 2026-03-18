<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemestreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up(): void
{
    Schema::create('semestre', function (Blueprint $table) {
        $table->id('id_semestre');
        $table->integer('año');
        $table->integer('periodo');
        $table->date('fecha_inicio');
        $table->date('fecha_fin');
        $table->date('fecha_inicio_inscripciones');
        $table->date('fecha_fin_inscripciones');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semestre');
    }
}
