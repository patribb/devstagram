<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>:)HoliGram - @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @stack('styles')
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-gray-100">
    <header class="p-5 bg-white border-b shadow">
        <div class="container mx-auto flex justify-between items-center">
            <a href='{{ route('home') }}' class="text-3xl font-black">:)HoliGram</a>
            @auth
                <nav class="flex gap-7 items-center">
                    <a href="{{route('posts.create')}}"
                        class="font-bold text-gray-600 text-sm flex items-center gap-2 bg-white border p-2 rounded cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                          </svg>
                        Crear</a>
                    <a class="font-bold text-gray-600 text-sm" href="{{ route('posts.index', auth()->user()->username) }}">Hola: <span
                            class="font-black text-black"><span>@</span>{{ auth()->user()->username }}</span></a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="font-bold text-gray-600 text-sm">Salir</button>
                    </form>
                </nav>
            @endauth
            @guest
                <nav class="flex gap-7 items-center">
                    <a class="font-bold text-gray-600 text-sm" href="{{ route('login') }}">Entar</a>
                    <a class="font-bold text-gray-600 text-sm" href="{{ route('register') }}">Crear cuenta</a>
                </nav>
            @endguest
        </div>
    </header>
    <main class="container px-10 mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">@yield('title')</h2>
        @yield('contenido')
    </main>
    <footer class="text-center p-5 text-gray-500 font-bold mt-10">
        :)HoliGram {{ now()->year }} - Todos los derechos reservados.
    </footer>
</body>

</html>
