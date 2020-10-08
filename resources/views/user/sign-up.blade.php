@extends('layout.master')
@section('title')
    Sign Up
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
                    <h1>Sign Up</h1>
                    <form method="POST" action="{{route('sign-up-post')}}">
                        <input type="hidden" value="sign-in-page" name="sign-in-page" id="sign-in-page">
                        <input class="form-control form-control-lg m-2"
                               id="firstName"
                               type="text"
                               name="firstName"
                               placeholder="First Name"
                               value="{{old('firstName')}}">
                        <input class="form-control form-control-lg m-2"
                               id="lastName"
                               type="text"
                               name="lastName"
                               placeholder="Last Name"
                               value="{{old('lastName')}}">
                        <input class="form-control form-control-lg m-2"
                               id="email"
                               type="text"
                               name="email"
                               placeholder="Email"
                               value="{{old('email')}}">
                        <input class="form-control form-control-lg m-2"
                               id="userName"
                               type="text"
                               name="userName"
                               placeholder="Username"
                               value="{{old('userName')}}">
                        <input class="form-control form-control-lg m-2"
                               id="password"
                               type="password"
                               name="password"
                               placeholder="Password">
                        <input class="form-control form-control-lg m-2"
                               id="password_confirmation "
                               type="password"
                               name="password_confirmation "
                               placeholder="Confirm Password">
                        <div class="form-group pt-3">
                            <button type="submit" class="btn ombre">Sign up</button>
                            <button type="reset" class="btn rev-ombre"><a href="{{route('sign-up')}}">Clear</a></button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            @else

                <div class="col-sm-12 col-md-10 col-lg-8">
                    <h1>Oops, you're already signed in.</h1>
                    <p>Please sign out to create a new account.</p>
                    <hr>

                    <form method="POST" action="{{route('sign-out')}}">
                        <li class="nav-link">
                            <button class="btn btn-light rev-ombre" type="submit">Sign-out</button>{{ csrf_field() }}
                        </li>
                    </form>
                </div>
            @endunless
        </div>
    </div>  <!-- end wrapper -->


@endsection

