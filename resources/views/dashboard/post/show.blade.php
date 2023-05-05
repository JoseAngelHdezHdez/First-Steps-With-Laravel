@extends('dashboard.layout')

@section('content')
    <h1>{{ $post->title }}</h1>

    <p>Esta posteado: {{$post->posted}}</p>

    <p>Descripcion</p>
    <p>{{$post->description}}</p>

    <div>{{$post->content}}</div>


@endsection
