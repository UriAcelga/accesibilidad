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

        return view('index', [
            'facultades' => $registrosFacultad,
            'estudiantes' => $registrosEstudiante,
        ]);
    }

    public function solicitudes() {
        $data = $this->facultadService->fetch();
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
