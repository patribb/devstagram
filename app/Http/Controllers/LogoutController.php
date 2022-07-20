<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store(Request $request)
    {
        // cierra la sesión
        auth()->logout();

        // redireccionar a login después de cerrar sesión
        return redirect()->route('login');
    }
}
