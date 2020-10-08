@extends('layout.master')
@section('title')
    Profile - {{$user->firstName}} {{$user->lastName}}
@endsection
@section('content')

    <header>
        @include('partials.nav')
        @include('partials.errors')
        @include('partials.message')
    </header>
    <div class="wrapper">
        <div class="container-fluid mb-3 p-0 mt-0 m-0 m-md-2 profile">
            <div class="row text-center" style="justify-content: center; margin: 0 auto">
                <div class="col-12 alert-banner pb-2 pt-4" style="justify-content: center; margin: 0 auto">
                    <div class="round-img-profile"
                         style="margin: 0 auto;background-image: url('{{ Storage::disk('s3')->url($user->profile_image)}}')">
                    </div>
                </div>
                <div class="col-12" style="justify-content: center; margin: 0 auto">
                    <h1 class="mt-3 viewing">{{ $user->userName }}'s Profile</h1>
                </div>
                <div class="col-12" style="justify-content: center; margin: 0 auto">

                    @if(Auth::check())
                        @if(Auth::user()->id != $user->id)
                            <button class="btn btn-sm ombre my-3" data-target="#personalMessageModal"
                                    data-toggle="modal">Send
                                Message
                            </button>
                            <button class="btn btn-sm ombre my-3" data-target="#reportModal"
                                    data-toggle="modal">Report User
                            </button>
                        @else
                            <button class="btn btn-md ombre"><a href="{{route('update-profile')}}">Edit Information</a>
                            </button>
                        @endif
                    @else
                        <button class="btn btn-sm ombre my-3" data-target="#signInModal"
                                data-toggle="modal">Send
                            Message
                        </button>
                    @endif
                </div>

            </div>
            <hr>
            <div class="col-12" style="justify-content: center; margin: 0 auto">

                <div class="card text-center m-0 m-md-5">
                    <div class="card-header" style="justify-content: center">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#insta">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#face">Posts</a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" data-toggle="tab" href="#twit">Pets</a>--}}
{{--                            </li>--}}
                        </ul>
                    </div>
                    <div class="tab-content card-body">
                        <div id="insta" class="tab-pane active">
                            <div class="card-body p-0 p-md-2">
                                <div class="row m-2" style="justify-content: center">
                                    <div class="col-12 col-md-4 p-0 p-md-5">
                                        @if($user->isAdmin())
                                            <div class="row" style="justify-content: center">
                                                <h2 class=" text-center"> Administrator <i class="fa fa-shield"
                                                                                           style="font-size: larger;"></i>
                                                </h2>
                                            </div>
                                        @endif
                                        <div class="row" style="justify-content: center">
                                            <p class=" text-center " style="color: #d13b16">Username:</p>&nbsp;
                                            <p class=" text-center "> {{$user->userName}}</p></div>
                                        @if($user->email_private === 0)
                                            <div class="row" style="justify-content: center"><p class=" text-center "
                                                                                                style="color: #d13b16">
                                                    Email: </p>
                                                &nbsp;<p class=" text-center"> {{$user->email}}</p>
                                            </div>
                                        @endif
                                        <div class="row" style="justify-content: center">
                                            <p style="color: #d13b16">Name: </p>&nbsp;
                                            <p class=" text-center"> {{$user->firstName}} {{$user->lastName}}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 p-0 p-md-5">
                                        <h2>{{$user->userName}}'s Bio </h2>
                                        @if($user->bio != '')
                                            {!! $user->bio !!}
                                        @else
                                            This user hasn't written a bio yet.
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="face" class="tab-pane">
                            @if($user->posts->count() > 0)
                                <div class="text-center">
                                    <h3>Displaying last 10 posts</h3>
                                    <p style="color: #d13b16; font-weight: bold"><a
                                            href="{{route('user-posts', ['id' => $user->id])}}">View Full Post
                                            History</a></p>
                                </div>
                                @foreach($user->posts->take(10) as $post)
                                    <a href="{{route('forum-details', ['id' => $post->id])}}">
                                        <div class="card col-xs-8 col-sm-12 my-2 text-left forum-cards m-0"
                                             style=" background-color: #e9e9e9">
                                            <div class="card-body row p-0 mt-2"
                                                 style="object-fit: cover; overflow: hidden;">
                                                <div class="col-sm-3 col-md-2 forum-thumb">
                                                    @if($post->img)
                                                        {!! $post->img !!}
                                                    @else
                                                        <img
                                                            src='https://pet-spot-bucket.s3.us-west-2.amazonaws.com/empty_dog.jpg'
                                                            alt="Pet Avatar"/>
                                                    @endif
                                                </div>

                                                <div class="col-sm-9 col-md-10 pl-2 ml-0 card-text">
                                                    <div class="float-right m-3 row">
                                                        <p style="color: #d13b16;"><i
                                                                class="fa fa-comments"></i> {{count($post->comments)}}
                                                        </p>
                                                    </div>
                                                    <h2 class="m-0" style="font-weight: bold;">{{$post->title}}</h2>
                                                    <p>Posted
                                                        by {{$post->author}} {{$post->created_at->diffForHumans()}}</p>
                                                    <p style="color: #d13b16;">{{$post->address_address}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <p class="m-2 text-center"> This user hasn't made any posts yet.</p>
                            @endif

                        </div>
{{--                        <div id="twit" class="tab-pane"><h3>{{$user->userName}}'s Pets</h3></div>--}}
                    </div>
                </div>

            </div>

        </div>
    </div>

    </div>

    <div class="modal fade" id="personalMessageModal" tabindex="-1" role="dialog"
         aria-labelledby="personalMessageModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="personalMessageModalLabel">Personal Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- sign-in modal body--}}
                <div class="modal-body">
                    @include('partials.personal-message')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="signInModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signInModalLabel">Welcome Back!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- sign-in modal body--}}
                <div class="modal-body">
                    @include('partials.sign-in-modal')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signUpModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signUpModalLabel">Create an Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- sign-in modal body--}}
                <div class="modal-body">
                    @include('partials.sign-up-modal')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Create an Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- sign-in modal body--}}
                <div class="modal-body">
                    @include('partials.report-user')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
<script>

    function openModal(id, email, state, type) {
        document.getElementById("alert_state").value = state;
        document.getElementById("alert_hidden_id").value = id;
        document.getElementById("alert_email").value = email;
        document.getElementById("alert_type").value = type;
        $('#editAlertModal').modal('show');
    }

    window.onload = function ready() {
        $('#profileMenu').collapse('show');
    }

</script>
