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
        Schema::create('departamentos', function(Blueprint $tabla) {
            $tabla->id();
            $tabla->string('facultad_codigo', 6);
            $tabla->foreign('facultad_codigo')
            ->references('codigo')
            ->on('facultades')
            ->onDelete('restrict')
            ->onUpdate('cascade');
            $tabla->string('nombre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamentos');
    }
};
