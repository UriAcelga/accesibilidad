<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {

    }
    
    public function register(Request $request) {
        $validacion = $request->validate([
            'rol' => 'required|in:becario,admin',
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
