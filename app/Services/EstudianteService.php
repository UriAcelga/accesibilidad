<?php

namespace App\Services;
use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class EstudianteService{
    /**
     * Retorna todas las facultades con sus respectivos departamentos y carreras. (Tanto id como nombre)
     */
    public function fetchAll(): Collection
    {
        return Estudiante::with('facultad', 'carrera', 'departamento')->get();
    }

    public function fetchTableCols(Request $request){
        return QueryBuilder::for(Estudiante::class, $request)
            ->allowedFields([
                'id',
                'apellido',
                'nombre',
                'email',
                'telefono',
                'cud',
                'created_at',
                'facultad_codigo',
                'carrera_id'
            ])
            ->allowedFilters([
                //Búsqueda por texto por nombre o CUD
                AllowedFilter::callback('buscar', function($query, $valor) {
                    $query->where(function ($query) use ($valor) {
                        $query->where('apellido', 'like', "%{$valor}%")
                            ->orWhere('nombre', 'like', "%{$valor}%")
                            ->orWhere('cud', 'like', "%{$valor}%");
                    });
                }),

                //Filtros por dropdown para facultad y carrera (departamento ??)
                AllowedFilter::exact('facultad_codigo'),
                AllowedFilter::exact('carrera_id'),

                //Rangos de fecha
                AllowedFilter::callback('creado_antes_de', function ($query, $valor) {
                    $query->where('created_at', '<=', $valor);
                }),
                AllowedFilter::callback('creado_despues_de', function ($query, $valor) {
                    $query->where('created_at', '>=', $valor);
                })
            ])
            ->allowedSorts([
                'apellido',
                'nombre',
                'email',
                'telefono',
                'cud',
                'created_at',
                'facultad_codigo',
                'carrera_id'
            ])
            ->allowedIncludes(['facultad', 'carrera'])
            ->defaultSort('-created_at')
            ->with(['facultad', 'carrera'])
            ->paginate(20)
            ->appends(request()->query());
            
    }
    /* Sin información de contacto (teléfono e email) */
    public function fetchTableColsForGuest(Request $request) {
        return QueryBuilder::for(Estudiante::class, $request)
            ->allowedFields([
                'apellido',
                'nombre',
                'cud',
                'created_at',
                'facultad_codigo',
                'carrera_id'
            ])
            ->allowedFilters([
                //Búsqueda por texto por nombre o CUD
                AllowedFilter::callback('buscar', function($query, $valor) {
                    $query->where(function ($query) use ($valor) {
                        $query->where('apellido', 'like', "%{$valor}%")
                            ->orWhere('nombre', 'like', "%{$valor}%")
                            ->orWhere('cud', 'like', "%{$valor}%");
                    });
                }),

                //Filtros por dropdown para facultad y carrera (departamento ??)
                AllowedFilter::exact('facultad_codigo'),
                AllowedFilter::exact('carrera.id'),

                //Rangos de fecha
                AllowedFilter::callback('creado_antes_de', function ($query, $valor) {
                    $query->where('created_at', '<=', $valor);
                }),
                AllowedFilter::callback('creado_despues_de', function ($query, $valor) {
                    $query->where('created_at', '>=', $valor);
                })
            ])
            ->allowedSorts([
                'apellido',
                'nombre',
                'cud',
                'created_at',
                'facultad_codigo',
                'carrera.nombre'
            ])
            ->allowedIncludes(['facultad', 'carrera'])
            ->defaultSort('-created_at')
            ->with(['facultad', 'carrera'])
            ->paginate(20)
            ->appends(request()->query());
    }

    public function getFichaById($id) {
        return Estudiante::find($id)?->ficha_academica;
    }

    public function getDataSeguimientoById($id) {
        return Estudiante::with('carrera:id,nombre')
        ->find($id, ['id', 'apellido', 'nombre', 'cud', 'facultad_codigo', 'carrera_id']);
    }
}