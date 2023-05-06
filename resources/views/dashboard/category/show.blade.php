@extends('dashboard.layout')

@section('content')
    <h1>{{ $category->title }}</h1>


    <p>Slug</p>
    <p>{{$category->slug}}</p>
@endsection
