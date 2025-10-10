<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Estudiante extends Model
{
    public function facultad(): BelongsTo
    {
        return $this->belongsTo(Facultad::class);
    }
    
    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }
    
    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class);
    }

}
