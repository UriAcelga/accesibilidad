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
            $tabla->string('email');
            $tabla->unsignedBigInteger('telefono');
            $tabla->timestamps();
            $tabla->integer('cud'); //limitar a 10 caracteres en el modelo
            $tabla->string('ficha_academica'); //se guarda un hash al archivo con extensión docx
            
            /*Agregar entrevistador (usuario no creado)
            
            $tabla->foreignId('entrevistador_id')
            ->nullable()
            ->constrained()
            ->onDelete('set null')
            ->onUpdate('cascade');
             */
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
