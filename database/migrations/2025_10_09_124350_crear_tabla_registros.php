<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registros', function(Blueprint $tabla) {
            $tabla->id();
            $tabla->string('apellido');
            $tabla->string('nombre');
            $tabla->integer('facultad');
            $tabla->integer('departamento');
            $tabla->integer('carrera');
            $tabla->string('email');
            $tabla->unsignedBigInteger('telefono');
            $tabla->timestamps();
            $tabla->foreignId('entrevistador_id')
            ->nullable()
            ->constrained()
            ->onDelete('set null')
            ->onUpdate('cascade');
            $tabla->string('cud', 15); //usar strtoupper
            $tabla->string('apoyos', 4000);
            $tabla->string('situacion', 4000);
            $tabla->string('descripcion', 4000);
            $tabla->string('ficha_academica'); //se guarda el nombre de archivo con extensión docx
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};
