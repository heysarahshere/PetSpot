@extends('layout.master')
@section('title')
    Adoption Form Saved
@endsection
@section('content')

    <header>
        @include('partials.nav')
        @include('partials.errors')
        @include('partials.message')
    </header>
    <div class="wrapper">

        <!-- Sidebar -->
    @include('partials.side-nav')

        <!-- Page Content -->

        <div class="container-fluid m-5">
            <h1>Thank you!</h1>
            <h2>Your application has been saved.</h2>
            <hr>
            <p>
                Please give our staff time to review it so that we can match you with the companion best suited to you.
                If you have applied for a specific animal, we will contact you regarding their status within 24 business hours of receiving your application.

               </p>
            <hr>
            <h2 class="strong">Feel free to contact us during business hours at (509) 488-5514</h2>
        </div>

    </div>

@endsection
