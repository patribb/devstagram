<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // validar el formulario de login
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // mantener abierta la sesión del usuario (habilitar desde login con remember)
        // comprobar que los datos son correctos
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje', 'Los datos introducidos no son correctos');
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
