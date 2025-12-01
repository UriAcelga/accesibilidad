<?php

namespace App\Http\Controllers;

use App\Services\EstudianteService;
use App\Services\WordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SeguimientoController extends Controller
{
    protected $wordService;

    public function index($id)
    {
        $serviceEstudiante = new EstudianteService();
        $estudiante = $serviceEstudiante->getDataSeguimientoById($id);
        return view('seguimiento', [
            'estudiante' => $estudiante,
        ]);
    }

    public function actualizar(Request $request, $id)
    {
        $request->merge([
            'asunto' => $request->input('asunto') ? str($request->input('asunto'))
                ->stripTags()
                ->squish()
                ->ucfirst()
                ->finish('.')
                ->toString() : '',
        ]);

        $validacion = $request->validate([
            'asunto' => 'string|min:10|max:4000',
        ]);
        $serviceEstudiante = new EstudianteService();
        $ficha = $serviceEstudiante->getFichaById($id) ?? 'error';
        $phpword = new WordService();
        $ruta = storage_path('app/private/seguimientos/' . $ficha);
        if (!file_exists($ruta)) {
            return redirect()->back()->withErrors(['noEncontrada' => 'Error al encontrar la ficha de seguimiento del estudiante.']);
        } else if($phpword->actualizarFicha($ruta, $validacion['asunto'], Auth::user()->name)) {
            return redirect()->back()->withErrors(['fichaCerrada' => 'La ficha de seguimiento está cerrada y no puede actualizarse']);
        } else {
            return redirect()->back()->with(['exitoActualizar' => true]);
        }
    }

    public function cerrar(Request $request, $id)
    {
        $request->merge([
            'causa' => $request->input('causa') ? str($request->input('causa'))
                ->stripTags()
                ->squish()
                ->ucfirst()
                ->finish('.')
                ->toString() : '',
        ]);

        $validacion = $request->validate([
            'causa' => 'string|min:10|max:4000',
        ]);
        $serviceEstudiante = new EstudianteService();
        $ficha = $serviceEstudiante->getFichaById($id);
        $phpword = new WordService();
        $ruta = storage_path('app/private/seguimientos/' . $ficha);
        if (!file_exists($ruta)) {
            return redirect()->back()->withErrors(['no_encontrada' => 'Error al encontrar la ficha de seguimiento del estudiante.']);
        } else if($phpword->cerrarFicha($ruta, $validacion['causa'])) {
            return redirect()->back()->withErrors(['fichaCerrada' => 'La ficha de seguimiento ya estaba cerrada previamente']);
        } else {
            return redirect()->back()->with(['exitoCerrar' => true]);
        }
    }

    public function descargar($id)
    {
        $serviceEstudiante = new EstudianteService();
        $ficha = $serviceEstudiante->getFichaById($id);
        $ruta = 'seguimientos/' . $ficha;
        if (Storage::disk('local')->exists($ruta)) {
            return Storage::download($ruta);
        }

        abort(404);
    }
}
