<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facultad extends Model
{
    public function departamentos(): HasMany
    {
        return $this->hasMany(Departamento::class);
    }

    public function carreras(): HasMany
    {
        return $this->hasMany(Carrera::class);
    }
}
