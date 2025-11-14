<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        if(AuthService::LimiteExcedido($request)) {
            $seg = AuthService::TiempoRestanteSeg($request);
            $mensaje = "Se ha excedido el límite de ingreso. Intente nuevamente en " . $seg . " segundos.";
            return redirect()->back()->withErrors(["rateLimit" => $mensaje]);
        }
        AuthService::IncrementarIntentos($request);
        dd(AuthService::IntentosRestantes($request));

        $request->validate([
            'rol' => 'required|in:usuario,ETA',
            'name' => 'string|required|max:255',
            'password' => 'string|required|min:8|max:72'
        ]);

        $userdata = [
            'name' => $request->input('name'),
            'password' => $request->input('password'),
            'is_admin' => $request->input('rol') == 'ETA'
        ];
        dd(Auth::attempt($userdata));
        

        return redirect()->route('home');
    }
    
    public function register(Request $request) {
        return redirect()->route('inicio');
        $validacion = $request->validate([
            'rol' => 'required|in:usuario,ETA',
            'name' => 'string|required|max:255|unique:users',
            'password' => 'string|required|min:8|max:72',
            'confirmpwd' => 'string|required|min:8|same:password'
        ]);

        $user = User::create($validacion);

        Auth::login($user);
        
        return redirect()->route('home');
    }

    public function logout() {

    }

}
