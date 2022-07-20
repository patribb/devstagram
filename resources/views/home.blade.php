@extends('layouts.app')
@section('title')
   Tu :)HoliGram
@endsection

@section('contenido')
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div class="bg-white p-3">
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}" class="">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="{{ $post->titulo }}" />
                    </a>
                    <div class="flex items-center justify-between">
                        <a href={{route('posts.index', $post->user)}} class="font-bold text-sm mt-2 text-gray-500"><span>@</span>{{$post->user->username}}</a>
                       <div class="flex gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="red" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg><span class='font-bold'>{{$post->likes->count()}}</span> likes
                       </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="my-10">
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-gray-600 font-bold text-center">No hay publicaciones aún, sigue a alguien para ver algunas.</p>
    @endif
@endsection
