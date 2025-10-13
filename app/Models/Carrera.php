<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Carrera extends Model
{
    protected $fillable = ['id', 'facultad_codigo', 'nombre'];
    protected $hidden = ['facultad_codigo'];

    public function facultad(): BelongsTo
    {
        return $this->belongsTo(Facultad::class);
    }
}
