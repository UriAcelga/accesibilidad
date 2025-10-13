<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facultad extends Model
{
    protected $primaryKey = 'codigo';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'facultades';

    protected $fillable = ['codigo', 'nombre'];

    public function departamentos(): HasMany
    {
        return $this->hasMany(Departamento::class);
    }

    public function carreras(): HasMany
    {
        return $this->hasMany(Carrera::class);
    }
}
