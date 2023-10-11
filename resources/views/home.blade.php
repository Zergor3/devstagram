@extends('layouts.app')

@section('titulo')
    Pagina Principal
@endsection

@section('contenido')
    <x-listar-post :posts="$posts" />
    {{-- <x-listar-post>
        <x-slot:titulo>
            <header>Esto es un header</header>
        </x-slot:titulo>
        <h1>Mostrando post desde slot</h1>
    </x-listar-post> --}}

    {{-- @forelse ($posts as $post)
        <h1>{{ $post->titulo }}</h1>
    @empty
        <p>No hay posts</p>
    @endforelse --}}
@endsection
