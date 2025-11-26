<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Services\WordService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EstudianteController extends Controller
{
    public function crear(Request $request) {
        $request->merge([
            'apellido' => $request->input('apellido') ? str($request->input('apellido'))
            ->stripTags()
            ->squish()
            ->ucfirst()
            ->toString() : '',
            
            'nombre' => $request->input('nombre') ? str($request->input('nombre'))
            ->stripTags()
            ->squish()
            ->ucfirst()
            ->toString() : '',

            'apoyo' => $request->input('apoyo') ? str($request->input('apoyo'))
            ->stripTags()
            ->squish()
            ->ucfirst()
            ->finish('.')
            ->toString() : '',

            'situacion' => $request->input('situacion') ? str($request->input('situacion'))
            ->stripTags()
            ->squish()
            ->ucfirst()
            ->finish('.')
            ->toString() : '',

            'descripcion' => $request->input('descripcion') ? str($request->input('descripcion'))
            ->stripTags()
            ->squish()
            ->ucfirst()
            ->finish('.')
            ->toString() : '',
        ]);
        $validacion = $request->validate([
            'apellido' => 'required|string|max:20',
            'nombre' => 'required|string|max:40',
            'facultad' => 'bail|required|string|exists:facultades,codigo',
            'carrera' => [
                'bail',
                'required',
                'string',
                Rule::exists('carreras', 'id')->where('facultad_codigo', $request->input('facultad')),
            ],
            'departamento' => [
                'bail',
                'required',
                'string',
                Rule::exists('departamentos', 'id')->where('facultad_codigo', $request->input('facultad')),
            ],
            'email' => 'bail|required|string|email',
            'tel' => 'required|phone:INTERNATIONAL,AR',
            'cud' => 'required|numeric|digits:10',
            'apoyo' => 'nullable|string|min:10|max:4000',
            'situacion' => 'nullable|string|min:10|max:4000',
            'descripcion' => 'nullable|string|min:10|max:4000',

        ], [
            'carrera.exists' => 'La carrera seleccionada no pertenece a la facultad seleccionada',
            'departamento.exists' => 'El departamento seleccionado no pertenece a la facultad seleccionada',
        ]);
        $userdata = [
            'apellido' => $validacion['apellido'],
            'nombre' => $validacion['nombre'],
            'email' => $validacion['email'],
            'telefono' => $validacion['tel'],
            'cud' => $validacion['cud'],
            'facultad_codigo' => $validacion['facultad'],
            'carrera_id' => $validacion['carrera'],
            'departamento_id' => $validacion['departamento'],
        ];
        $seguimiento_data = [
            'apoyo' => $validacion['apoyo'] ?? null,
            'situacion' => $validacion['situacion'] ?? null,
            'descripcion' => $validacion['descripcion'] ?? null,
        ];
        $phpword = new WordService();
        $ruta = $phpword->crear(
            $userdata['apellido'],
            $userdata['nombre'],
            $userdata['cud'],
            $seguimiento_data['apoyo'],
            $seguimiento_data['situacion'],
            $seguimiento_data['descripcion'],
        );
        $userdata['ficha_academica'] = $ruta;

        $estudiante = Estudiante::create($userdata);
        return redirect()->to('seguimiento/' . $estudiante->id);
    }
}
