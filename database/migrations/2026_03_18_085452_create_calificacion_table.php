<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   
public function up(): void
{
    Schema::dropIfExists('calificacion');
    
    Schema::create('calificacion', function (Blueprint $table) {
        $table->id('id_calificacion');
        $table->unsignedBigInteger('id_inscripcion');
        $table->enum('desempenio', ['malo', 'bueno', 'excelente'])->nullable();
        $table->string('observaciones', 255)->nullable();
        $table->timestamps();

        $table->foreign('id_inscripcion')->references('id_inscripcion')->on('inscripcion');
    });
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificacion');
    }
}
