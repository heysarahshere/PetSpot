@extends('layout.master')
@section('title')
    Donation - Success
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
            <h2>Your donation is being processed.</h2>
            <hr>
            <p>
                If you would like to receive updates, feel free to contact us during business hours at (509) 488-5514.
            </p>
            <p>
                To manage your subscriptions and see past donations, go to Account > Donations. </p>
        </div>

    </div>

@endsection
