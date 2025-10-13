<?php

namespace App\Services;
use App\Models\Facultad;
use Illuminate\Database\Eloquent\Collection;

class FacultadService {
    /**
     * Retorna todas las facultades con sus respectivos departamentos y carreras. (Tanto id como nombre)
     */
    public function fetch(): Collection
    {
        return Facultad::with('carreras', 'departamentos')->get();
    }
}