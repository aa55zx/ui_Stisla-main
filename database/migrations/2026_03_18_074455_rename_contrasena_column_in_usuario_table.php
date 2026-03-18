<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE USUARIO CHANGE `contraseña` contrasena VARCHAR(255) NOT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE USUARIO CHANGE contrasena `contraseña` VARCHAR(255) NOT NULL');
    }
};