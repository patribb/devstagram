@extends('layouts.app')
@section('title')
Iniciar sesión en :)HoliGram
@endsection
@section('contenido')
<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="md:w-6/12 p-5">
        <img src="{{ asset('img/login.jpg') }}" alt="Inicio de sesión" />
    </div>
    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
        <form action="{{ route('login') }}" method="POST" novalidate>
            @csrf
            @if (session('mensaje'))
            <p class="bg-red-500 mt-2 mb-2 text-white font-black rounded-lg text-sm p-2 text-center">
                {{ session('mensaje') }}
            </p>
            @endif
            <div class="mb-5">
                <label for="email" class="mb-2 block text-gray-500 font-bold">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu correo electrónico" "
                                class=" border p-3 w-full rounded-lg outline-none @error('email') border-red-500
                    @enderror" />
                @error('email')
                <p class="bg-red-500 mt-2 text-white font-black rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 block text-gray-500 font-bold">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="Elige tu contraseña"
                    class="border p-3 w-full rounded-lg outline-none  @error('password') border-red-500 @enderror" />
                @error('password')
                <p class="bg-red-500 mt-2 text-white font-black rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <input type="checkbox" name="remember" /> <span class="text-gray-500 font-bold text-sm">Mantener abierta mi sesión</span>
            </div>
            <input type="submit" value="Iniciar sesión"
                class="bg-black text-white hover:bg-gray-800 transition-colors cursor-pointer font-bold w-full rounded-lg p-3" />
        </form>
    </div>
</div>
@endsection
