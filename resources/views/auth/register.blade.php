@extends('layouts.app')
@section('title')
    Regístrate en :)HoliGram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Regsitro de usuario" />
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block text-gray-500 font-bold">Nombre</label>
                    <input type="text" name="name" id="name" placeholder="Tu nombre"
                        class="border p-3 w-full rounded-lg outline-none @error('name') border-red-500 @enderror"
                        value="{{ old('name') }} "/>
                    @error('name')
                        <p class="bg-red-500 mt-2 text-white font-black rounded-lg text-sm p-2 text-center">{{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block text-gray-500 font-bold">Usuario</label>
                    <input type="text" name="username" id="username" placeholder="Tu nombre de usuario"
                        class="border p-3 w-full rounded-lg outline-none  @error('username') border-red-500 @enderror"
                        value="{{ old('username') }}" />
                    @error('username')
                        <p class="bg-red-500 mt-2 text-white font-black rounded-lg text-sm p-2 text-center">{{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block text-gray-500 font-bold">Email</label>
                    <input type="email" name="email" id="email" placeholder="Tu correo electrónico"
                    value="{{ old('email') }}"
                        class="border p-3 w-full rounded-lg outline-none  @error('email') border-red-500 @enderror" />
                    @error('email')
                        <p class="bg-red-500 mt-2 text-white font-black rounded-lg text-sm p-2 text-center">{{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block text-gray-500 font-bold">Contraseña</label>
                    <input type="password" name="password" id="password" placeholder="Elige tu contraseña"
                        class="border p-3 w-full rounded-lg outline-none  @error('password') border-red-500 @enderror" />
                    @error('password')
                        <p class="bg-red-500 mt-2 text-white font-black rounded-lg text-sm p-2 text-center">{{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block text-gray-500 font-bold">Repetir contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder='Repite tu contraseña' class="border p-3 w-full rounded-lg outline-none" />
                </div>
                <input type="submit" value="Crear cuenta"
                    class="bg-black text-white hover:bg-gray-800 transition-colors cursor-pointer font-bold w-full rounded-lg p-3">
            </form>
        </div>
    </div>
@endsection
