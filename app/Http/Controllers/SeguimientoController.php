<?php

namespace App\Http\Controllers;

use App\Services\WordService;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    protected $wordService;

    public function index(){
        return view('seguimiento');
    }

    public function actualizar() {
        
    }

    public function cerrar() {

    }

    public function descargar() {

    }
}
