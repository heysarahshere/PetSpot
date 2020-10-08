@extends('layout.master')
@section('title')

    @if(Auth::check())
        <?PHP $user = Auth::user(); ?>
        Profile - {{$user->firstName}} {{$user->lastName}}
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
                        <h1 class="mt-3 viewing">Welcome, {{ $user->userName }}.</h1>
                    </div>
                </div>

                <div class="col-12">

                    <div class="accordion" id="profileAccordion">
                        {{-- info card --}}
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseInfo" aria-expanded="true" aria-controls="collapseInfo">
                                        Personal Information
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseInfo" class="collapse show" aria-labelledby="headingOne" data-parent="#profileAccordion">
                                <div class="card-body">
                                    <div class="row m-2">
                                        <div class="col-sm-12 col-md-10 col-lg-6 p-5">
                                            @if($user->isAdmin())
                                                <div class="row"><h2 > Administrator <i class="fa fa-shield" style="font-size: larger;"></i></h2></div>
                                            @endif
                                            <div class="row"><p style="color: #d13b16">Username: </p>&nbsp;<p> {{$user->userName}}</p></div>
                                            <div class="row"><p style="color: #d13b16">Email: </p>&nbsp;<p> {{$user->email}}</p></div>
                                            <div class="row"><p style="color: #d13b16">Name: </p>&nbsp;<p> {{$user->firstName}} {{$user->lastName}}</p></div>
                                        </div>
                                        <div class="m-auto mb-3">
                                            <button class="btn btn-md ombre"><a href="{{route('update-profile')}}">Edit Information</a></button>
                                            <button class="btn btn-md rev-ombre"><a data-toggle="modal" data-target="#changePasswordModal">Change Password</a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- posts card --}}
                        <div class="card">
                            <div class="card-header" id="heading2">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsePosts" aria-expanded="false" aria-controls="collapsePosts">
                                        Recent Posts
                                    </button>
                                </h2>
                            </div>
                            <div id="collapsePosts" class="collapse" aria-labelledby="heading2" data-parent="#profileAccordion">
                                <div class="card-body">
                                    @if($posts->count() > 0)
                                        <div class="text-center">
                                            <h3>Displaying last 10 posts</h3>
                                            <p><a href="{{route('my-posts')}}">View Full Post History</a></p>
                                        </div>
                                        @foreach($posts as $post)
                                            <a href="{{route('forum-details', ['id' => $post->id])}}">
                                                <div class="card col-12 m-2">
                                                    <div class="card-body row">
                                                        <div class="col-sm-12 col-md-7">
                                                            <h2 class="m-0" style="font-weight: bold">{{$post->title}}</h2>
                                                            <p >Posted {{$post->created_at->diffForHumans()}} From {{$post->address_address}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @else
                                        <p class="m-2 text-center">No posts to show. <a style="color: #d13b16" href="{{route('post-new')}}"> Create one now.</a></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- adopt card --}}
                        <div class="card">
                            <div class="card-header" id="heading3">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseAdopt" aria-expanded="false" aria-controls="collapseAdopt">
                                        Adoption Applications
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseAdopt" class="collapse" aria-labelledby="heading3" data-parent="#profileAccordion">
                                <div class="card-body">
                                    @if(count($adoptionForms) > 0)
                                        @foreach($adoptionForms as $adoptionForm)
                                            <a href="{{route('adopt-form-edit', ['id' => $adoptionForm->id])}}">
                                                <div class="card col-12 m-2">
                                                    <div class="card-body row">
                                                        <div class="col-12 col-sm-6 text-left">
                                                            <h5 class="lead">Adoption Application for {{ $adoptionForm->pet_name }}</h5>
                                                            <p style="font-weight: bold">Status: {{$adoptionForm->status}}</p>
                                                        </div>
                                                        <div class="col-12 col-sm-6 text-left text-md-right">
                                                            <p style="color: #d13b16;">Created {{$adoptionForm->created_at->diffForHumans()}}</p>
                                                            <p>In {{$adoptionForm->city}}, {{$adoptionForm->state}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @else
                                        <p class="m-2 text-center">No adoption applications to show. <a style="color: #d13b16" href="{{route('adopt-form')}}"> Apply now.</a></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- foster card --}}
                        <div class="card">
                            <div class="card-header" id="heading4">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFoster" aria-expanded="false" aria-controls="collapseFoster">
                                        Foster Applications
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFoster" class="collapse" aria-labelledby="heading4" data-parent="#profileAccordion">
                                <div class="card-body">
                                    @if(count($fosterForms) > 0)
                                        @foreach($fosterForms as $fosterForm)

                                            <a href="{{route('foster-form-edit', ['id' => $fosterForm->id])}}">
                                                <div class="card col-12 m-2">
                                                    <div class="card-body row">
                                                        <div class="col-12 col-sm-6 text-left">
                                                            <h5 class="lead">Foster application for {{ $fosterForm->pet_name }}</h5>
                                                            <p style="font-weight: bold">Status: {{$fosterForm->status}}</p>
                                                        </div>
                                                        <div class="col-12 col-sm-6 text-left text-md-right">
                                                            <p style="color: #d13b16;">Created {{$fosterForm->created_at->diffForHumans()}}</p>
                                                            <p>In {{$fosterForm->city}}, {{$fosterForm->state}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @else
                                        <p class="m-2 text-center">No foster applications to show. <a style="color: #d13b16" href="{{route('foster-form')}}"> Apply now.</a></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- alerts card --}}
                        <div class="card">
                            <div class="card-header" id="heading5">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseAlerts" aria-expanded="false" aria-controls="collapseAlerts">
                                        Active Pet Alerts
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseAlerts" class="collapse alert-profile" aria-labelledby="heading5" data-parent="#profileAccordion">
                                <div class="card-body" style="margin: 0 auto">
                                    <h2 class="m-2 text-center"><a style="color: #d13b16" href="{{route('create-alert')}}">Create new alert</a></h2>
                                    <div class="row" style="justify-content: center">
                                        @if(count($alerts) > 0)
                                            @foreach($alerts as $alert)
                                                <div class="col-12 col-md-10 col-lg-4 col-xl-3 pb-3">
                                                    <div class="card pet-alert-card card-hover pet-card" style="position: relative;">
                                                        <div class="mb-2" id="{{ $alert->id }}">

                                                            <a onclick="openModal('{{$alert->id}}','{{$alert->email}}','{{$alert->state}}','{{$alert->type}}')">
                                                                <div class="card-body text-center" style="margin: 0 auto">
                                                                    <div class="card-img-top">
                                                                        <img src='{{ Storage::disk('s3')->url($alert->img) }}'
                                                                             alt="Cat alert icon">
                                                                    </div>
                                                                    <h2>{{$alert->type}}s in {{ $alert->state }}</h2>
                                                                    <h3>Notfying: {{ $alert->email }}</h3>
                                                                    <h3></h3>

                                                                </div>

                                                            </a>
                                                            <form action="{{ route('delete-alert') }}" method="post">
                                                                <td class="right" style="z-index: 1000">
                                                                    <input type="hidden" value="{{$alert->id}}" name="alert_id" id="alert_id">
                                                                    <button type="submit"  onclick="return confirm('Are you sure you want to delete this comment?')" class="btn reveal ombre-nb px-2 float-right btn-lg"
                                                                            style="position: absolute; top: 10px; right: 2%">
                                                                        <p style="color: white;font-size: larger"><i class="fa fa-trash"></i></p>
                                                                    </button>
                                                                </td>
                                                                @csrf
                                                            </form>
                                                        </div>
                                                        <div class="card-footer text-center">
                                                            <x-small class="text-muted text-center">Found {{$alert->type}} Alert</x-small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="m-2 text-center">No active alerts to show. <a style="color: #d13b16" href="{{route('create-alert')}}"> Create one now.</a></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="editAlertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="alertModalLabel">Found Pet Alert Creation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{-- sign-in modal body--}}
                    <div class="modal-body">
                        @include('partials.edit-modal')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
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
                <h1>Oops, you need an admin account to do that.</h1>
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
