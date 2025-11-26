<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Estudiante extends Model
{
    protected $table = 'registros';
    protected $fillable = [
        'apellido',
        'nombre',
        'email',
        'telefono',
        'cud',
        'ficha_academica',
        'departamento_id',
        'carrera_id',
        'facultad_codigo'
    ];

    protected $hidden = [
        'ficha_academica'
    ];

    protected function casts(): array
    {
        return [
            'ficha_academica' => 'hashed',
        ];
    }

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
