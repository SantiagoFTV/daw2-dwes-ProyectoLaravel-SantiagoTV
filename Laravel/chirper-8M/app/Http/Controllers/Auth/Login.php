<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function __invoke(Request $request)
    {
        // Validar los campos
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intento de inicio de sesion
        if (Auth::attempt($credenciales, $request->boolean('remember'))) {
            // Regenerar la sesion para evitar fijacion de sesion
            $request->session()->regenerate();

            // Redirigir a la pagina deseada o al inicio
            return redirect()->intended('/')
                ->with('success', '¡Bienvenido de nuevo!');
        }

        // Si el inicio de sesion falla, redirigir de vuelta con error
        return back()
            ->withErrors(['email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.'])
            ->onlyInput('email');
    }
}
