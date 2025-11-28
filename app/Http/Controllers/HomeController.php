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
        if($sort) {
            $ariaSort = $sort[0] === '-' ? 'descending' : 'ascending';
        }

        dsp en th:
        <th scope="col" aria-sort="{{ $ariaSort }}"> 

        //asc
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7 3V21M7 3L11 7M7 3L3 7M14 3H15M14 9H17M14 15H19M14 21H21" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>

        //desc
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7 3V21M7 21L3 17M7 21L11 17M14 3H21M14 9H19M14 15H17M14 21H15" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>

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
