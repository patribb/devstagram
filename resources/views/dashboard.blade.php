@extends('layouts.app')

@section('title')
    Perfil: {{ $user->username }}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 px-10 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-8">
                <img src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.png') }}"
                    alt="Usuario" class='rounded-full object-cover'>
            </div>
            <div
                class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center py-10 md:py-10 md:justify-center md:items-start ">
                <div class="flex items-center gap-2">
                    <p class="text-gray-700 font-black text-2xl"><span>@</span>{{ $user->username }}</p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('perfil.index') }}" class="text-gray-500 hover:text-gray-600"
                                title="Editar perfil">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>
                <p class="text-gray-800-text-sm mb-2 mt-5 font-bold">{{$user->followers->count()}}
                    <span class="font-normal">
                        @choice('Seguidor|Seguidores', $user->followers->count())
                    </span>
                </p>
                <p class="text-gray-800-text-sm mb-2 font-bold">{{$user->followings->count()}}
                    <span class="font-normal">
                        @choice('Seguido|Seguidos', $user->followings->count())
                    </span>
                </p>
                <p class="text-gray-800-text-sm mb-2 font-bold">{{ $user->posts->count() }}
                    <span class="font-normal">
                        @choice('Post|Posts', $user->posts->count())
                    </span>
                </p>
                @auth
                    @if ($user->id !== auth()->user()->id)
                        @if (!$user->siguiendo(auth()->user()))
                        <form action="{{ route('users.follow', $user) }}" method="POST">
                            @csrf
                            <input type="submit" value="Seguir"
                                class="bg-gray-600 text-white rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">
                        </form>
                        @else
                        <form action="{{ route('users.unfollow', $user) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="submit" value="Dejar de seguir"
                                class="bg-gray-600 text-white rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">
                        </form>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>
    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center my-10 font-black">Publicaciones</h2>
        @if ($posts->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div class="bg-white p-3">
                        <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}" class="">
                            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="{{ $post->titulo }}" />
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="my-10">
                {{ $posts->links() }}
            </div>
        @else
            <p class="text-gray-600 font-bold text-center">No hay publicaciones aún</p>
        @endif
    </section>
@endsection
