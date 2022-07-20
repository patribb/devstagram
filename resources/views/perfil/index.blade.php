@extends('layouts.app')
@section('title')
Editar perfil
@endsection
@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{ route('perfil.store') }}" enctype="multipart/form-data" class="mt-10 md:mt-0" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block text-gray-500 font-bold">Usuario</label>
                    <input type="text" name="username" id="username" placeholder="Tu nombre"
                        class="border p-3 w-full rounded-lg outline-none @error('username') border-red-500 @enderror"
                        value="{{ auth()->user()->username }} "/>
                    @error('username')
                        <p class="bg-red-500 mt-2 text-white font-black rounded-lg text-sm p-2 text-center">{{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imagen" class="mb-2 block text-gray-500 font-bold">Imagen de perfil</label>
                    <input type="file" name="imagen" id="imagen"
                        class="border p-3 w-full rounded-lg outline-none text-xs"
                        accept=".jpg, .jpeg, .png, .gif"/>
                </div>
                <input type="submit" value="Actualizar"
                    class="bg-black text-white hover:bg-gray-800 transition-colors cursor-pointer font-bold w-full rounded-lg p-3">
            </form>
        </div>
    </div>
@endsection
