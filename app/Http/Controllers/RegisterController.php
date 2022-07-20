<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Modificar el request para recibir el error de username duplicado
        $request->request->add(['username' => Str::slug($request->username)]);

        // validación del formulario de regsitro
        $this->validate($request, [
            'name' => 'required|max:50',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|max:100|email',
            'password' => 'required|min:6|confirmed',
        ]);

        // crear el usuario y almacenar en la bd
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Autenticar un usuario (forma 1)
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        // Autenticar un usuario (forma 2)
        auth()->attempt($request->only('email', 'password'));

        // redireccionar al usuario después de registrar el formulario
        return redirect()->route('posts.index', auth()->user());

    }

}
