@extends('layout.master')
@section('title')
    Sign In
@endsection
@section('content')

    <header>
        @include('partials.nav')
        <h3>@include('partials.message')</h3>
        <h3 class="error">@include('partials.errors')</h3>
    </header>
    <div class="wrapper">

        <!-- Sidebar -->
    @include('partials.side-nav')

    <!-- Page Content -->
        <div class="container m-4">

            @unless(Auth::check())


                <div class="col-sm-12 col-md-10 col-lg-8">
                    <h1>Sign In</h1>
                    <form method="POST" action="{{route('sign-in-post')}}">
                        <input type="hidden" value="sign-in-page" name="sign-in-page" id="sign-in-page">
                        <input class="form-control form-control-lg m-2"
                               id="email"
                               type="text"
                               name="email"
                               placeholder="Email">
                        <input class="form-control form-control-lg m-2"
                               id="password"
                               type="password"
                               name="password"
                               placeholder="password">
                        <div class="form-group pt-3">
                            <button type="submit" class="btn ombre">Sign in</button>
                            <button type="button" class="btn rev-ombre"><a href="#">Forgot Password?</a></button>
                        </div>
                        {{ csrf_field() }}
                        <a href="{{route('sign-up')}}">New? Create an account.</a>
                    </form>
                </div>

            @else
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <h1>Oops, you're already signed in.</h1>
                    <p>Please sign out to switch accounts.</p>
                    <hr>

                    <form method="POST" action="{{route('sign-out')}}">
                        <li class="nav-link">
                            <button class="btn btn-light rev-ombre" type="submit">Sign-out</button>{{ csrf_field() }}
                        </li>
                    </form>
                </div>
        @endunless
    </div>
    </div>

@endsection
