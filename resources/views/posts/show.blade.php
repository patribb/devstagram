@extends('layouts.app')
@section('title')
    {{ $post->titulo }}
@endsection
@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2 bg-white p-3 shadow">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="{{ $post->titulo }}">
            <div class="p-3  flex items-center gap-4">
                @auth
                @if ($post->checkLike(auth()->user()))
                <form action="{{ route('posts.likes.destroy', $post) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="my-4">
                        <button class="" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="red" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
                @else
                <form action="{{ route('posts.likes.store', $post) }}" method="POST">
                    @csrf
                    <div class="my-4">
                        <button class="" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
                @endif
                @endauth
                <p class='font-bold'> {{$post->likes->count()}} <span class="font-normal">likes</span></p>
            </div>
            <div class="">
                <p class="font-bold"><span>@</span>{{ $post->user->username }}</p>
                <p class="text-xs text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">{{ $post->descripcion }}</p>
            </div>
            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @method('DELETE')
                        <!--metodo no soportado(como eliminar y actualizar) -->
                        @csrf
                        <input type="submit" value="Eliminar post"
                            class="bg-red-500 text-xs font-bold text-white hover:bg-red-600 p-2 rounded mt-4 cursor-pointer" />
                    </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">Añade un comentario</p>
                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center font-black ">
                            {{ session('mensaje') }}
                        </div>
                    @endif
                    <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            {{-- <label for="comentario" class="mb-2 block text-gray-500 font-bold">Comentario</label> --}}
                            <textarea name="comentario" id="comentario" placeholder="Comenta algo sobre este post..."
                                class="border p-3 w-full rounded-lg outline-none  @error('comentario') border-red-500 @enderror"></textarea>
                            @error('comentario')
                                <p class="bg-red-500 mt-2 text-white font-black rounded-lg text-sm p-2 text-center">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <input type="submit" value="Publicar"
                            class="bg-black text-white hover:bg-gray-800 transition-colors cursor-pointer font-bold w-full rounded-lg p-3" />
                    </form>
                @endauth
                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.index', $comentario->user) }}"
                                    class="font-bold text-sm"><span>@</span>{{ $comentario->user->username }}</a>
                                <p class="text-sm">{{ $comentario->comentario }}</p>
                                <p class="text-xs text-gray-300">{{ $comentario->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center text-gray-400 font-bold text-sm">No hay comentarios para este post...</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
