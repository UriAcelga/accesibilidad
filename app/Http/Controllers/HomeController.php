<?php

namespace App\Http\Controllers;

use App\Services\EstudianteService;
use Illuminate\Http\Request;
use App\Services\FacultadService;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $facultadService;
    protected $estudianteService;

    public function __construct(FacultadService $facultad, EstudianteService $estudiante)
    {
        $this->facultadService = $facultad;
        $this->estudianteService = $estudiante;
    }

    public function index(Request $request) {
        if(Auth::user()->is_admin) {
            $registrosEstudiante = $this->estudianteService->fetchTableCols($request);
        } else {
            $registrosEstudiante = $this->estudianteService->fetchTableColsForGuest($request);
        }
        
        $registrosFacultad = $this->facultadService->fetch();
        /*
        $sort = request('sort');
        $ariaSort = 'none';
        if($sort === 'field') {
            $ariaSort = $sort[0] === '-' ? 'descending' : 'ascending';
        }

        dsp en th:
        <th scope="col" aria-sort="{{ $ariaSort }}"> 
        */
        return view('index', [
            'facultades' => $registrosFacultad,
            'estudiantes' => $registrosEstudiante,
        ]);
    }

    public function solicitudes() {
        $data = $this->facultadService->fetch();

        /*$ruta = Storage::disk('local')->path('seguimientos') . '/' . 'gomez_uriel_fernando_1111111111_2025-11-06_14-26-01.docx';
        $word = new WordService();
        $word->cerrarFicha($ruta, 'rehabilitación terminada, ya no requiere asistencia ni monitoreo.');
        dd(WordService::getDocMetadata($ruta));*/

        return view('solicitud', [
            'facultades' => $data
        ]);
    }

    public function login() {
        return view('login');
    }

    public function registro() {
        return redirect()->route('login');
    }
}
