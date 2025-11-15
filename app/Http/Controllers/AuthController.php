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

        if(Auth::attempt($userdata)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        };
        
        return redirect()->back()->withErrors([
            'usuario' => 'Credenciales de usuario inválidas.'
        ]);

    }
    
    public function register(Request $request) {
        return redirect()->route('login');
        $validacion = $request->validate([
            'rol' => 'required|in:usuario,ETA',
            'name' => 'string|required|max:255|unique:users',
            'password' => 'string|required|min:8|max:72',
            'confirmpwd' => 'string|required|min:8|same:password'
        ]);

        $userdata = [
            'name' => $request->input('name'),
            'password' => $request->input('password'),
            'is_admin' => $request->input('rol') == 'ETA'
        ];

        $user = User::create($validacion);

        Auth::login($user);
        
        return redirect()->route('home');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
