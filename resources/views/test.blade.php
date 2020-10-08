@extends('layout.master')
@section('title')
    Scrape Test
@endsection
@section('content')

    <header>
        @include('partials.nav')
        @include('partials.message')
        @include('partials.errors')
    </header>
    <div class="wrapper">
        <div class="container">
            <hr>
            <h1>Scrape Test</h1>
            @foreach($values as $value)
                <h3>{{$value}}</h3>
            @endforeach
        </div>
    </div>

@endsection
