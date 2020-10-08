@extends('layout.master')
@section('title')
    Error - 404 Not Found
@endsection
@section('content')
    <header>
        @include('partials.nav')
        @include('partials.errors')
        @include('partials.message')
    </header>
    <section>
        <div class="wrapper">
        <div class="container" style="margin: 5%; min-height: 25vh">
            <div class="row" style="justify-content: center">
                <div class="col-6">
                    <h2>Error 404 - Page Not Found</h2>
                    <h3><a href="{{route('index')}}">< Back to Home</a></h3>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
