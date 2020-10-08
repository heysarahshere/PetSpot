@extends('layout.master')
@section('title')

    @if(Auth::check())
        <?PHP $user = Auth::user(); ?>
        Moderated Forums - {{$user->firstName}} {{$user->lastName}}
    @else
        Oops
    @endif
@endsection
@section('content')

    <header>
        @include('partials.nav')
        @include('partials.errors')
        @include('partials.message')
    </header>
    @if(Auth::check())
        <?PHP $user = Auth::user(); ?>
        <div class="wrapper">
            <!-- Sidebar -->
        @include('partials.side-nav')

        <!-- Page Content -->

            <div class="container-fluid mb-3 p-0 mt-0 m-0 m-md-2 profile">
                <div class="ml-4 row my-3 text-left" style="margin: 0 auto">
                    <div class="col-xs-7 col-sm-2 col-xl-1">
                        <div class="round-img"
                             style="background-image: url('{{ Storage::disk('s3')->url($user->profile_image)}}')">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-10 col-md-9">
                        <h1 class="mt-3 viewing">{{ $user->userName }} is not a moderator of any forums.</h1>
                    </div>
                </div>

                <div class="col-12">


            </div>
        </div>
        </div>

        {{-- not logged in --}}
    @else
        <div class="wrapper">
            <!-- Sidebar -->

        @include('partials.side-nav')
        <!-- Page Content -->
            <div class="p-4">
                <h1>Oops, you need an account to do that.</h1>
                <hr>
                <button class="btn ombre"><a href="{{route('login')}}">Sign-In</a></button>
                <button class="btn light-ombre"><a href="{{route('sign-up')}}">Sign-Up</a></button>
            </div>
        </div>  <!-- end wrapper -->

    @endif
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- sign-in modal body--}}
                <div class="modal-body">
                    @include('partials.reset-password')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
