<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up(): void
{
    Schema::dropIfExists('instructor');
    
    Schema::create('instructor', function (Blueprint $table) {
        $table->integer('id_instructor')->primary();
        $table->unsignedBigInteger('id_departamento');
        $table->string('especialidad', 100)->nullable();
        $table->timestamps();

        $table->foreign('id_departamento')->references('id_departamento')->on('departamento');
    });

    DB::statement('ALTER TABLE instructor ADD CONSTRAINT instructor_usuario_fk FOREIGN KEY (id_instructor) REFERENCES usuario(id)');
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructor');
    }
}
