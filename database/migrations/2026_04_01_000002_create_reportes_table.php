<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 150);
            $table->text('descripcion')->nullable();
            $table->enum('estado', ['pendiente', 'en_revision', 'resuelto', 'rechazado'])->default('pendiente');
            $table->enum('prioridad', ['baja', 'media', 'alta', 'critica'])->default('media');
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->date('fecha_limite')->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categorias')->nullOnDelete();
            $table->foreign('usuario_id')->references('id')->on('usuarios')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
