<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FacultadService;
use App\Services\WordService;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    protected $facultadService;

    public function __construct(FacultadService $data)
    {
        $this->facultadService = $data;
    }

    public function index() {
        return view('index');
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
        return view('registro');
    }
}
