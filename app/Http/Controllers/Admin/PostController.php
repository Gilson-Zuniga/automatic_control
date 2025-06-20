<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->get();

        return view('admin.posts.index', compact('posts')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.posts.create', compact('users')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|min:10|max:30',
            'asunto' => 'required|string|min:3|max:100',
            'contenido' => 'required|string|min:3|max:200',
        ]);

        // Asigna automáticamente el ID del usuario autenticado
        $data['user_id'] = auth()->id();

        // Guarda correctamente el post
        Post::create($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Perfecto!',
            'string' => 'Se ha publicado un nuevo post con éxito',
        ]);

        return redirect()->route('admin.posts.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $users = User::all();
        return view('admin.posts.edit', compact('users')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'titulo' => 'required|string|min:10|max:30',
            'asunto'=>'required|string|min:3|max:100',
            'contenido' => 'required|string|min:3|max:200',
            'user_id' => 'required|exists:users,id'
        ]);

        $post->update([
            'titulo' => $data['titulo'],
            'asunto'=> $data['asunto'],
            'contenido' => $data['contenido'],
            'user_id' => $data['user_id']
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡ Bien crack !',
            'string' => 'Se ha editado el post con éxito'
        ]);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡ Bien crack !',
            'string' => 'Se ha eliminado el post con éxito'
        ]);

        return redirect()->route('admin.posts.index');
    }
}
