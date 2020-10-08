@extends('layout.master')
@section('title')
    Create Alert
@endsection
@section('content')

    <header>
        @include('partials.nav')
        <h3>@include('partials.message')</h3>
        <h3 class="error">@include('partials.errors')</h3>
    </header>

    <div class="wrapper">
        <div class="container-fluid donate-container p-0"
             style="justify-content:center;text-align: center; margin: 0 auto">

            <div class="row alert-banner pt-3 pb-4" style="justify-content:center;text-align: center; margin: 0 auto">
                <div class="col-12 col-sm-10 col-md-8 col-lg-4 col-xl-5 main-alert-img ">
                    {{-- Image swap 1 --}}
                    <a onclick="swapImg(1)">
                        <img class=" " id="img-1" style="width: 100%; height: auto; display: block; z-index: 999"
                             src="{{ Storage::disk('s3')->url('pet-alert-1.png') }}"
                             alt="Cat alert icon">
                    </a> {{-- End Image swap 1 --}}

                    {{-- Image swap 2 --}}
                    <a onclick="swapImg(2)">
                        <img class=" " id="img-2" style="width: 100%; height: auto; display: none; z-index: 999"
                             src="{{ Storage::disk('s3')->url('pet-alert-2.png') }}"
                             alt="Cat alert icon">
                    </a> {{-- End Image swap 2 --}}

                    {{-- Image swap 3 --}}
                    <a onclick="swapImg(3)">
                        <img class=" " id="img-3" style="width: 100%; height: auto; display: none; z-index: 999"
                             src="{{ Storage::disk('s3')->url('pet-alert-3.png') }}"
                             alt="Cat alert icon">
                    </a> {{-- End Image swap 3 --}}

                </div>

            </div>
            <div class="row" style="justify-content: center">
                <div class="col-7 col-md-4 mt-1">
                    <img class="petspot-img" src="{{asset('images/pet-spotter.png')}}" alt="First slide">
                </div>
            </div>
            {{-- heading --}}
            <div class="alert-text pt-1">
                <h1 class="viewing" style="color: #d13b16">Found Pet Alert System</h1>
            </div>  {{-- end heading --}}

            {{-- subheading --}}
            <div class="row" style="display: block; justify-content: center; margin: 0 auto">
                <div class="col-12 col-md-10 col-lg-8 col-xl-6" style="justify-content: center; margin: 0 auto">
                    <p style="color: #74797b; font-weight: bold "><span class="lead" style="color: black;">Set up an alert to be notified when matching pets are posted on the forum by
                        users or by the National Lost & Found Pets database crawler. To choose the way we notify you, go to Profile > Preferences.</span>
                        You can have up to 12 active alerts at a given time, but keep in mind that each alert will
                        trigger a new
                        notification when a matching found pet is posted.</p>
                </div>
                <hr>
            </div>  {{-- End subheading --}}

            {{-- card container --}}
            <div class="container p-0 p-md-5">
                {{--  cards  --}}
                <div class="row m-0 m-md-2" style="justify-content: center">
                    {{-- card 1 --}}
                    <div class="alert-row-1 col-12 col-md-6 col-lg-3">
                        <div class="card pet-alert-card card-hover pet-card" style="position: relative;">
                            <div class="mb-2" id="cat">
                                <div class="card-body text-center" style="margin: 0 auto">
                                    <div class="card-img-top">
                                        <img src="{{ Storage::disk('s3')->url('cat-alert.png') }}"
                                             alt="Cat alert icon">
                                    </div>
                                </div>

                                <x-small class="text-muted">Found Cat Alert</x-small>
                            </div>
                            <div class="card-footer">
                                @if(Auth::check())
                                    <button class="btn btn-large btn-outline-light ombre mt-4"
                                            onclick="openModal('Cat')">
                                        Select
                                    </button>
                                @else
                                    <button class="btn btn-large btn-outline-light ombre mt-4"
                                            data-toggle="modal" data-target="#signInModal">
                                        Select
                                    </button>
                                @endif
                            </div>
                        </div>
                        </a>
                    </div>  {{-- end card 1 --}}
                    {{-- card 2 --}}
                    <div class="alert-row-1 col-12 col-md-6 col-lg-3">
                        <div class="card pet-alert-card card-hover pet-card" style="position: relative;">
                            <div class="mb-2" id="dog">
                                <div class="card-body text-center" style="margin: 0 auto">
                                    <div class="card-img-top">
                                        <img src="{{ Storage::disk('s3')->url('dog-alert.png') }}"
                                             alt="Dog alert icon">
                                    </div>
                                </div>
                                <x-small class="text-muted">Found Dog Alert</x-small>
                            </div>
                            <div class="card-footer">
                                @if(Auth::check())
                                    <button class="btn btn-large btn-outline-light ombre mt-4"
                                            onclick="openModal('Dog')">
                                        Select
                                    </button>
                                @else
                                    <button class="btn btn-large btn-outline-light ombre mt-4"
                                            data-toggle="modal" data-target="#signInModal">
                                        Select
                                    </button>
                                @endif
                            </div>
                        </div>
                        </a>
                    </div>  {{-- end card 2 --}}
                    {{-- card 3 --}}
                    <div class="alert-row-1 col-12 col-md-6 col-lg-3">
                        <div class="card pet-alert-card card-hover pet-card" style="position: relative;">
                            <div class="mb-2" id="bird">
                                <div class="card-body text-center" style="margin: 0 auto">
                                    <div class="card-img-top">
                                        <img src="{{ Storage::disk('s3')->url('bird-alert.png') }}"
                                             alt="Bird alert icon">
                                    </div>
                                </div>
                                <x-small class="text-muted">Found Bird Alert</x-small>
                            </div>
                            <div class="card-footer">
                                @if(Auth::check())
                                    <button class="btn btn-large btn-outline-light ombre mt-4"
                                            onclick="openModal('Bird')">
                                        Select
                                    </button>
                                @else
                                    <button class="btn btn-large btn-outline-light ombre mt-4"
                                            data-toggle="modal" data-target="#signInModal">
                                        Select
                                    </button>
                                @endif
                            </div>
                        </div>
                        </a>
                    </div>  {{-- end card 3 --}}
                    {{-- card 4 --}}
                    <div class="alert-row-1 col-12 col-md-6 col-lg-3">
                        <div class="card pet-alert-card card-hover pet-card" style="position: relative;">
                            <div class="mb-2" id="other">
                                <div class="card-body text-center" style="margin: 0 auto">
                                    <div class="card-img-top">
                                        <img src="{{ Storage::disk('s3')->url('other-alert.png') }}"
                                             alt="Other alert icon">
                                    </div>
                                </div>
                                <x-small class="text-muted">Found Other Pet Alert</x-small>
                            </div>
                            <div class="card-footer">
                                @if(Auth::check())
                                    <button class="btn btn-large btn-outline-light ombre mt-4"
                                            onclick="openModal('Other')">
                                        Select
                                    </button>
                                @else
                                    <button class="btn btn-large btn-outline-light ombre mt-4"
                                            data-toggle="modal" data-target="#signInModal">
                                        Select
                                    </button>
                                @endif
                            </div>
                        </div>
                        </a>
                    </div>  {{-- end card 4 --}}
                </div>{{-- end row --}}
            </div>

            {{-- Alert Modal --}}
            <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel"
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
                            @include('partials.alert-modal')
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- sign-in modal --}}
            <div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="signInModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="signInModalLabel">Welcome back!</h5>
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

            {{-- sign-up modal --}}
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
        </div>

    </div>  {{-- end wrapepr --}}


@endsection

<script>
    function swapImg(id) {
        if (id === 1) {
            // show img 2
            document.getElementById("img-2").style.display = "flex";
            document.getElementById("img-2").style.opacity = "10";
            document.getElementById("img-2").style.visibility = "visible";
            // hide img 1
            document.getElementById("img-1").style.display = "none";
            document.getElementById("img-1").style.opacity = "0";
            document.getElementById("img-1").style.visibility = "hidden";
            // swap
            document.getElementById("img-left").src = "{{ Storage::disk('s3')->url('alert-scene1.png') }}";
            document.getElementById("img-right").src = "{{ Storage::disk('s3')->url('alert-scene3.png') }}";
        } else if (id === 2) {
            // show img 3
            document.getElementById("img-3").style.display = "flex";
            document.getElementById("img-3").style.opacity = "10";
            document.getElementById("img-3").style.visibility = "visible";
            // hide img 2
            document.getElementById("img-2").style.display = "none";
            document.getElementById("img-2").style.opacity = "0";
            document.getElementById("img-2").style.visibility = "hidden";
            // swap
            document.getElementById("img-left").src = "{{ Storage::disk('s3')->url('alert-scene-2.png') }}";
            document.getElementById("img-right").src = "{{ Storage::disk('s3')->url('alert-scene1.png') }}";
        } else if (id === 3) {
            // show img 1
            document.getElementById("img-1").style.display = "flex";
            document.getElementById("img-1").style.opacity = "10";
            document.getElementById("img-1").style.visibility = "visible";
            // hide img 3
            document.getElementById("img-3").style.display = "none";
            document.getElementById("img-3").style.opacity = "0";
            document.getElementById("img-3").style.visibility = "hidden";
            // swap
            document.getElementById("img-left").src = "{{ Storage::disk('s3')->url('alert-scene3.png') }}";
            document.getElementById("img-right").src = "{{ Storage::disk('s3')->url('alert-scene-2.png') }}";
        } else {
        }
    }

    function openModal(type) {
        document.getElementById("alertTitle").innerHTML = type + " Alert";
        document.getElementById("type").value = type;
        $('#alertModal').modal('show');
    }
</script>
