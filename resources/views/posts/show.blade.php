@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex p-2">
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
            @auth
                @if($post->user_id === auth()->user()->id)                
                <form method="POST" action="{{ route('posts.destroy', $post) }}">
                    @method('DELETE') {{-- Method spoofing --}}
                    @csrf
                    <input 
                        type="submit"
                        value="Eliminar Publicación"
                        class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4
                        cursor-pointer"
                    />
                </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth                    
                <p class="text-xl font-bold text-center mb-5">
                    Nuevo Comentario
                </p>
                @if (session('mensaje'))
                    <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                        {{session('mensaje')}}
                    </div>
                @endif
                <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                            Agrega un comentario
                        </label>
                        <textarea id="comentario" name="comentario" placeholder="Agregar comentario" class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror"></textarea>
                        @error('comentario')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="submit" value="Comentar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"/>
                </form>
                @endauth
                @if ($post->comentarios->count())
                   <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                         @foreach ( $post->comentarios as $comentario )
                             <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.index', $comentario->user ) }}" class="font-bold">
                                    {{$comentario->user->username}}
                                </a> 
                                <p>{{ $comentario->comentario }}</p>
                                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                             </div>
                         @endforeach
                    </div>
                @else
                    <p class="p-10 text-center">No hay comentarios aún</p>
                @endif
            </div>
        </div>
    </div>
@endsection