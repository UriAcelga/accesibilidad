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
        return view('seguimiento', [
            'id' => $id
        ]);
    }

    public function actualizar(Request $request, $id)
    {
        $request->merge([
            'asunto' => $request->input('asunto') ? str($request->input('asunto'))
                ->stripTags()
                ->squish()
                ->ucfirst()
                ->toString() : '',
        ]);

        $validacion = $request->validate([
            'asunto' => 'string|min:10|max:4000',
        ]);
        $serviceEstudiante = new EstudianteService();
        $ficha = $serviceEstudiante->getFichaById($id);
        $phpword = new WordService();
        $phpword->actualizarFicha($ficha, $validacion['asunto'], Auth::user()->name);
        return redirect()->back()->with(['estado' => 'exitoActualizar']);
    }

    public function cerrar(Request $request, $id)
    {
        $request->merge([
            'causa' => $request->input('causa') ? str($request->input('causa'))
                ->stripTags()
                ->squish()
                ->ucfirst()
                ->toString() : '',
        ]);

        $validacion = $request->validate([
            'causa' => 'string|min:10|max:4000',
        ]);
        $serviceEstudiante = new EstudianteService();
        $ficha = $serviceEstudiante->getFichaById($id);
        $phpword = new WordService();
        $phpword->cerrarFicha($ficha, $validacion['causa']);
        return redirect()->back()->with(['estado' => 'exitoCerrar']);
    }

    public function descargar($id)
    {
        $serviceEstudiante = new EstudianteService();
        $ficha = $serviceEstudiante->getFichaById($id);
        $ruta = 'private/' . $ficha;
        dd($ficha, $ruta);
        if (Storage::disk('local')->exists($ruta)) {
            return Storage::download($ruta);
        }

        abort(404);
    }
}
