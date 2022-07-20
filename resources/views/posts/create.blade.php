@extends('layouts.app')
@section('title')
    Crea una nueva publicación
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
  <div class="md:flex md:items-center">
    <div class="md:w-1/2 px-10">
        <form action="{{ route('imagenes.store') }}" enctype="multipart/form-data" method="POST" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
            @csrf
        </form>
    </div>
    <div class="md:w-1/2 bg-white p-10 rounded-lg shadow-lg mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block text-gray-500 font-bold">Título</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Título para tu publicación..."
                        class="border p-3 w-full rounded-lg outline-none @error('titulo') border-red-500 @enderror"
                        value="{{ old('titulo') }}"
                        />
                    @error('titulo')
                        <p class="bg-red-500 mt-2 text-white font-black rounded-lg text-sm p-2 text-center">{{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block text-gray-500 font-bold">Descripción</label>
                    <textarea name="descripcion" id="descripcion" placeholder="Cuenta algo sobre tu post..."
                        class="border p-3 w-full rounded-lg outline-none  @error('descripcion') border-red-500 @enderror"
                    >{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="bg-red-500 mt-2 text-white font-black rounded-lg text-sm p-2 text-center">{{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input name='imagen' type="hidden" value='{{ old('imagen') }}' />
                    @error('imagen')
                        <p class="bg-red-500 mt-2 text-white font-black rounded-lg text-sm p-2 text-center">{{ $message }}
                        </p>
                    @enderror
                </div>
                <input type="submit" value="Publicar"
                    class="bg-black text-white hover:bg-gray-800 transition-colors cursor-pointer font-bold w-full rounded-lg p-3" />
            </form>
    </div>
  </div>
@endsection
