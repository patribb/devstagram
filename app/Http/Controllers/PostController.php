<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        // revisa que el usuario esté autenticado
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user)
    {
        // buscar los posts de un usuario
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // validar formulario
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        //& crear y almacenar post el post(forma1 -> llena los campos y guarda)
        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id,
        // ]);

        //& crear post(forma2 -> primero llena los campos y después guardamos)
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        //& crear y almacenar un post con una relación(forma 3)
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);


        // redireccionar al usuario al muro
        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        // eliminar un post
        // comprobar que quien elimina el post es el autor del mismo
        $this->authorize('delete', $post); // mediante el policy
        $post->delete();

        // eliminar la imagen al eliminar el post
        $imagen_path = public_path('uploads/' . $post->imagen);
        if(File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        // redireccional al usuario después de eliminar el post
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
