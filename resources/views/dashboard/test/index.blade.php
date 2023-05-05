@extends('layout.master')

@section('content')
@include('fragment.subview')

    {{ $name }}
    {{-- $age --}}
    <!-- {{ $age }} -->
    {{ $html }}
    {!! $html !!}

    @if (false)
        Es true
    @else
        No es true
    @endif

    @foreach ($post as $a)
    <div class="box">
        <p>*{{$a}}</p>
    </div>
    @endforeach
    <hr>
    @forelse ($post as $a)
        <div class="box">
            <p>{{ $a }}</p>
        </div>
    @empty
        No hay data
    @endforelse
@endsection
