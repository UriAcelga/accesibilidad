<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AuthService {
    public static function LimiteExcedido(Request $request) {
        return RateLimiter::tooManyAttempts('enviar-formulario:' . $request->ip(), 10);
    }

    public static function IncrementarIntentos(Request $request) {
        RateLimiter::hit('enviar-formulario:' . $request->ip(), 180);
    }

    public static function TiempoRestanteSeg(Request $request) {
        return RateLimiter::availableIn('enviar-formulario:' . $request->ip());
    }

    public static function IntentosRestantes(Request $request) {
        return RateLimiter::retriesLeft('enviar-formulario:' . $request->ip(), 10);
    }
}