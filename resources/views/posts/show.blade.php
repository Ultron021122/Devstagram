@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads').'/'.$post->imagen }}" alt="Imagen del post {{ $post->titulo }}"/>
            <div class="p-3">
                <p>0 Likes</p>
                <p class="font-bold mt-1"> {{ $post->user->username }} </p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-2">
                    {{ $post->descripcion }}
                </p>
            </div>
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth                    
                <p class="text-xl font-bold text-center mb-5">
                    Nuevo Comentario
                </p>
                <form action="">
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                            Agrega un comentario
                        </label>
                        <textarea id="comentario" name="comentario" placeholder="Agregar comentario" class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror">
                        </textarea>
                        @error('comentario')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <input type="submit" value="Comentar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"/>
                </form>
                @endauth
            </div>
        </div>
    </div>
@endsection