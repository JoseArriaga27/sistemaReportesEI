<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();

            $table->string('nombre', 80);
            $table->string('apellidoPaterno', 80);
            $table->string('apellidoMaterno', 80)->nullable();

            $table->string('correoElectronico', 120)->unique();
            $table->string('telefono', 20);

            $table->date('fechaNacimiento');

            $table->string('password');
            $table->boolean('es_admin')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
