@extends('layout.master')
@section('title')

    @if(Auth::check())
        <?PHP $user = Auth::user(); ?>
        Inbox - {{$user->firstName}} {{$user->lastName}}
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

            <div class="container-fluid mb-3 mt-0 m-0 m-md-2 m-lg-4 profile">
                <div class="ml-4 row my-3 text-left" style="margin: 0 auto">
                    <div class="col-xs-7 col-sm-2 col-xl-1">
                        <div class="round-img"
                             style="background-image: url('{{ Storage::disk('s3')->url($user->profile_image)}}')">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-10 col-md-9">
                        <h2 class="ml-3 mt-3 viewing">{{Auth::user()->userName}}'s Inbox</h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">

                        <div class="accordion" id="profileAccordion">

                            {{-- CARD ONE - RECEIVED --}}
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne">
                                            {{count($in_message_threads) ?? 0}} Received Messages
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                     data-parent="#profileAccordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2>Received</h2>
                                                @forelse($in_message_threads as $thread)
                                                    @unless(Auth::user()->id === $thread->sender->id )
                                                        @if($thread->receiver_deleted == 0)

                                                            <div class="alert"
                                                                 style="background-color: rgba(158,210,113,0.71); position: relative"
                                                                 role="alert">
                                                                <form id="form+{{ $thread->id }}"
                                                                      action="{{route('delete-thread')}}" method="post">
                                                                    <input type="hidden" name="id" id="id"
                                                                           value="{{ $thread->id }}">
                                                                    <button
                                                                        class="btn btn-md float-right p-2 mark-as-read"
                                                                        style="position: absolute; top: 2px; right: 2px"
                                                                        onclick="document.getElementById('form+{{ $thread->id }}').submit();">
                                                                        <i class="fa fa-close"></i>
                                                                    </button>
                                                                    {{ csrf_field() }}
                                                                </form>
                                                                <div class="col">
                                                                    <a href="{{route('get-message', ['id' => $thread->id])}}">
                                                                        <h4>{{$thread->subject}}
                                                                            from {{$thread->sender->userName}}</h4>
                                                                        <h5>{{$thread->created_at->diffForHumans()}}</h5>
                                                                    </a>
                                                                </div>

                                                            </div>
                                                        @endif
                                                    @endunless
                                                    {{-- allow reply in modal--}}
                                                    @if($loop->last)

                                                        <form name="delete-read" action="{{route('delete-received')}}"
                                                              method="post"
                                                              class=" ml-auto text-right">
                                                            <button class="btn btn-sm rev-ombre">Delete All Received
                                                                Messages
                                                            </button>
                                                            {{ csrf_field() }}
                                                        </form>
                                                    @endif
                                                @empty
                                                    There are no new messages.
                                                @endforelse

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo">
                                            {{count($out_message_threads) ?? 0}} Sent Messages
                                        </button>
                                    </h5>
                                </div>

                                {{--   CARD TWO - SENT--}}
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                     data-parent="#profileAccordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2>Sent</h2>
                                                @forelse($out_message_threads as $thread)
                                                    @unless(Auth::user()->id === $thread->receiver->id )
                                                        @if($thread->sender_deleted == 0 )

                                                            <div class="alert"
                                                                 style="background-color: rgba(83,168,170,0.62); position: relative"
                                                                 role="alert">
                                                                <form id="form+{{ $thread->id }}"
                                                                      action="{{route('delete-thread')}}" method="post"
                                                                      style="z-index: 999">
                                                                    <input type="hidden" name="id" id="id"
                                                                           value="{{ $thread->id }}">
                                                                    <button
                                                                        class="btn btn-md float-right p-2 mark-as-read"
                                                                        style="position: absolute; top: 2px; right: 2px"
                                                                        onclick="document.getElementById('form+{{ $thread->id }}').submit();">
                                                                        <i class="fa fa-close"></i>
                                                                    </button>
                                                                    {{ csrf_field() }}
                                                                </form>
                                                                <a href="{{route('get-message', ['id' => $thread->id])}}">
                                                                    {{$thread->subject}}
                                                                    with {{$thread->receiver->userName}}
                                                                    <h5>{{$thread->created_at->diffForHumans()}}</h5>
                                                                </a>

                                                            </div>
                                                        @endif
                                                    @endunless
                                                    {{-- allow reply in modal--}}
                                                    @if($loop->last)

                                                        <form name="delete-read" action="{{route('delete-sent')}}"
                                                              method="post"
                                                              class=" ml-auto text-right">
                                                            <button class="btn btn-sm rev-ombre">Delete All Sent
                                                                Messages
                                                            </button>
                                                            {{ csrf_field() }}
                                                        </form>

                                                    @endif
                                                @empty
                                                    There are no new messages.
                                                @endforelse
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
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
                <h1>Oops, you need an account to do that.</h1>
                <hr>
                <button class="btn ombre"><a href="{{route('login')}}">Sign-In</a></button>
                <button class="btn light-ombre"><a href="{{route('sign-up')}}">Sign-Up</a></button>
            </div>
        </div>  <!-- end wrapper -->

    @endif
@endsection
<script>
    window.onload = function ready() {
        $('#profileMenu').collapse('show');
    }
</script>
