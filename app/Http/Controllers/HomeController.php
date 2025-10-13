<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FacultadService;

class HomeController extends Controller
{
    protected $facultadService;

    public function __construct(FacultadService $data)
    {
        $this->facultadService = $data;
    }

    public function index() {
        $data = $this->facultadService->fetch();
        return view('index', [
            'facultades' => $data
        ]);
    }
}
