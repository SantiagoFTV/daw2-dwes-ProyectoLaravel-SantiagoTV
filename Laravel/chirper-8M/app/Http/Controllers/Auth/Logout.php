<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logout extends Controller
{
    public function __invoke(Request $request)
    {
        // Cerrar sesión del usuario
        Auth::logout();

        // Invalidar la sesión actual
        $request->session()->invalidate();

        // Regenerar el token CSRF
        $request->session()->regenerateToken();

        return redirect('/')->with('success', '¡Sesión cerrada!');
    }
}
