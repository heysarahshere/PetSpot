@extends('layout.master')
@section('title')

    @if(Auth::check())
        <?PHP $user = Auth::user(); ?>
        Notifications - {{$user->firstName}} {{$user->lastName}}
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
                        <h2 class="mt-3 viewing">{{ $user->userName}}'s Notifications</h2>
                    </div>
                </div>

                <div class="accordion" id="profileAccordion">
                    {{-- message notifs --}}
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                    {{$message_count ?? 0}} Unread Messages
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse
                            @if($message_count > 0)
                            show
                            @endif
                            " aria-labelledby="headingOne" data-parent="#profileAccordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h2>Unread Messages</h2>
                                        @forelse($unread_messages as $message)

                                            <div class="alert p-1 p-md-2"
                                                 style="position: relative; border: 2px solid rgba(208,43,0,0.91); background-color: rgba(255,60,0,0.46)"
                                                 role="alert">
                                                <form name="mark-read" action="{{route('mark-read')}}"
                                                      method="post" class=" ml-auto text-right">
                                                    <input type="hidden" name="notif_id" id="notif_id"
                                                           value="{{ $message->id }}">
                                                    <button class="btn btn-md float-right p-2 mark-as-read"
                                                            onclick="document.getElementById('mark-read').submit();">
                                                        <i
                                                            class="fa fa-close"></i></button>
                                                    {{ csrf_field() }}
                                                </form>
                                                <div class="row">
                                                    <div class="col-12 p-0">
                                                        <a href="{{route('read-from-link', [ 'read' => $message->id])}}">
                                                            <input type="hidden" name="notif_id" id="notif_id"
                                                                   value="{{$message->id}}">
                                                            {{ csrf_field() }}
                                                            <h4 style="color: #000000;font-weight: lighter">Unread Message: <span style="font-weight: bold">{{$message->data['thread']['subject']}}</span>
                                                                from <span style="font-weight: bold">{{$message->data['sender']['userName']}} | </span><span
                                                                    style="color: #b12907">{{$message->created_at->diffForHumans()}}</span>
                                                            </h4>
                                                        </a>
                                                    </div>


                                                </div>
                                            </div>
                                            @if($loop->last)
                                                <a href="#" id="mark-all">
                                                    Mark all as read
                                                </a>
                                            @endif

                                        @empty
                                            There are no new notifications.
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- comment notifs --}}
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                        aria-expanded="false" aria-controls="collapseTwo">
                                    {{$comment_count ?? 0}} New Comments
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse
                            @if($comment_count > 0)
                            show
                            @endif
                            " aria-labelledby="headingTwo" data-parent="#profileAccordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h2>Comments</h2>
                                        @forelse($comments as $comment)
                                            <div class="alert p-1 p-md-2"
                                                 style="position: relative; border: 2px solid rgba(208,43,0,0.91); background-color: rgba(255,60,0,0.46)"
                                                 role="alert">

                                                <form name="mark-read" action="{{route('mark-read')}}"
                                                      method="post" class=" ml-auto text-right">
                                                    <input type="hidden" name="notif_id" id="notif_id"
                                                           value="{{ $comment->id }}">
                                                    <button class="btn btn-md float-right p-2 mark-as-read"
                                                            onclick="document.getElementById('mark-read').submit();">
                                                        <i
                                                            class="fa fa-close"></i></button>
                                                    {{ csrf_field() }}
                                                </form>
                                                <div class="row">
                                                    <div class="col-12 p-0">
                                                        <a href="{{route('read-from-link', [ 'read' => $comment->id])}}">
                                                            <input type="hidden" name="notif_id" id="notif_id"
                                                                   value="{{$comment->id}}">
                                                            {{ csrf_field() }}
                                                            <h4 style="color: #000000;font-weight: lighter">New Comment
                                                                on <span
                                                                    style="font-weight: bold">{{$comment->data['post']['title']}}</span>
                                                                by
                                                                <span style="font-weight: bold">{{$comment->data['sender']['userName']}} | </span><span
                                                                    style="color: #b12907">{{$comment->created_at->diffForHumans()}}</span>
                                                            </h4>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($loop->last)
                                                <a href="#" id="mark-all">
                                                    Mark all as read
                                                </a>
                                            @endif
                                        @empty
                                            There are no new notifications.
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- pet alert notifs --}}
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                    {{$alert_count ?? 0}} Found Pet Alerts
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse
                            @if($alert_count > 0)
                            show
                            @endif
                            " aria-labelledby="headingThree" data-parent="#profileAccordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h2>Found Pet Alerts</h2>
                                        @forelse($alerts as $alert)
                                            <div class="alert p-1 p-md-2"
                                                 style="position: relative; border: 2px solid rgba(208,43,0,0.91); background-color: rgba(255,60,0,0.46)"
                                                 role="alert">
                                                <form name="mark-read" action="{{route('mark-read')}}"
                                                                    method="post" class=" ml-auto text-right">
                                                    <input type="hidden" name="notif_id" id="notif_id"
                                                           value="{{ $alert->id }}">
                                                    <button class="btn btn-md float-right p-2 mark-as-read"
                                                            onclick="document.getElementById('mark-read').submit();">
                                                        <i
                                                            class="fa fa-close"></i></button>
                                                    {{ csrf_field() }}
                                                </form>
                                                <div class="row">
                                                    <div class="col-12 p-0">
                                                        <a href="{{route('read-from-link', [ 'read' => $alert->id])}}">
                                                            <input type="hidden" name="notif_id" id="notif_id"
                                                                   value="{{$alert->id}}">
                                                            {{ csrf_field() }}
                                                            <h4 style="color: #000000;font-weight: lighter">Alert:
                                                                <span
                                                                    style="font-weight: bold">
                                                   New found {{$alert->data['type']}} post in {{$alert->data['state']}}. </span>
                                                            </h4>
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                            @if($loop->last)
                                                <a href="#" id="mark-all-pet">
                                                    Mark all as read
                                                </a>
                                            @endif
                                        @empty
                                            There are no new alerts.
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($user->isAdmin())
                        {{-- admin notifs --}}
                        <div class="card">
                            <div class="card-header" id="headingAdmin1">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseAdmin1" aria-expanded="false"
                                            aria-controls="collapseAdmin1">
                                        ADMIN | {{$report_count ?? 0}} Reported Posts
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseAdmin1" class="collapse
                            @if($report_count > 0)
                                show
                                @endif
                                " aria-labelledby="headingAdmin1" data-parent="#profileAccordion">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-12">
                                            <h2>Reported Posts</h2>
                                            @forelse($reports as $report)

                                                <div class="alert p-1 p-md-2"
                                                     style="position: relative; border: 2px solid rgba(208,43,0,0.91); background-color: rgba(255,60,0,0.46)"
                                                     role="alert">
                                                    <form name="mark-read" action="{{route('mark-read')}}"
                                                          method="post" class=" ml-auto text-right">
                                                        <input type="hidden" name="notif_id" id="notif_id"
                                                               value="{{ $report->id }}">
                                                        <button class="btn btn-md float-right p-2 mark-as-read"
                                                                onclick="document.getElementById('mark-read').submit();">
                                                            <i class="fa fa-close"></i></button>
                                                        {{ csrf_field() }}
                                                    </form>
                                                    <div class="row">
                                                        <div class="col-12 p-0">
                                                            <a onclick="submitAlertNotif('{{$report->id}}')">
                                                                <a href="{{route('read-from-link', [ 'read' => $report->id])}}">
                                                                    <input type="hidden" name="notif_id" id="notif_id"
                                                                           value="{{$report->id}}">
                                                                    {{ csrf_field() }}
                                                                    <h4 style="color: #000000;font-weight: lighter">
                                                                        URGENT:
                                                                        <span style="font-weight: bold">
                                                   Post "{{$report->data['post']['title']}}" was reported as {{$report->data['reason']}}. </span>
                                                                    </h4>
                                                                </a>
                                                            </a>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>

                                                @if($loop->last)
                                                    <a href="#" id="mark-all-pet">
                                                        Mark all as read
                                                    </a>
                                                @endif
                                            @empty
                                                There are no new contact requests.
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- admin notifs - users reporte --}}
                        <div class="card">
                            <div class="card-header" id="headingAdmin3">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseAdmin3" aria-expanded="false"
                                            aria-controls="collapseAdmin3">
                                        ADMIN | {{$user_report_count ?? 0}} Reported Users
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseAdmin3" class="collapse
                            @if($user_report_count > 0)
                                show
                                @endif
                                " aria-labelledby="headingAdmin3" data-parent="#profileAccordion">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-12">
                                            <h2>Reported Users</h2>
                                            @forelse($user_reports as $user)

                                                <div class="alert p-1 p-md-2"
                                                     style="position: relative; border: 2px solid rgba(208,43,0,0.91); background-color: rgba(255,60,0,0.46)"
                                                     role="alert">

                                                    <form name="mark-read" action="{{route('mark-read')}}"
                                                          method="post" class=" ml-auto text-right">
                                                        <input type="hidden" name="notif_id" id="notif_id"
                                                               value="{{ $user->id }}">
                                                        <button class="btn btn-md float-right p-2 mark-as-read"
                                                                onclick="document.getElementById('mark-read').submit();">
                                                            <i class="fa fa-close"></i></button>
                                                        {{ csrf_field() }}
                                                    </form>
                                                    <div class="row">
                                                        <div class="col-12 p-0">
                                                            <a onclick="submitAlertNotif('{{$user->id}}')">
                                                                <a href="{{route('read-from-link', [ 'read' => $user->id])}}">
                                                                    <input type="hidden" name="notif_id" id="notif_id"
                                                                           value="{{$user->id}}">
                                                                    {{ csrf_field() }}
                                                                    <h4 style="color: #000000;font-weight: lighter">
                                                                        URGENT:
                                                                        <span style="font-weight: bold">
                                                                            User "{{$user->data['user']['userName']}}"</span>
                                                                        was reported for<span style="font-weight: bold"> {{$user->data['reason']}}. </span>
                                                                    </h4>
                                                                </a>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>

                                                @if($loop->last)
                                                    <a href="#" id="mark-all-pet">
                                                        Mark all as read
                                                    </a>
                                                @endif
                                            @empty
                                                There are no new reported users.
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- admin notifs - dcontact --}}
                        <div class="card">
                            <div class="card-header" id="headingAdmin">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseAdmin" aria-expanded="false"
                                            aria-controls="collapseAdmin">
                                        ADMIN | {{$request_count ?? 0}} Contact Requests
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseAdmin" class="collapse
                            @if($request_count > 0)
                                show
                                @endif
                                " aria-labelledby="headingAdmin" data-parent="#profileAccordion">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-12">
                                            <h2>Contact Requests</h2>
                                            @forelse($requests as $request)

                                                <div class="alert p-1 p-md-2"
                                                     style="position: relative; border: 2px solid rgba(208,43,0,0.91); background-color: rgba(255,60,0,0.46)"
                                                     role="alert">
                                                    <form name="mark-read" action="{{route('mark-read')}}"
                                                          method="post" class=" ml-auto text-right">
                                                        <input type="hidden" name="notif_id" id="notif_id"
                                                               value="{{ $request->id }}">
                                                        <button class="btn btn-md float-right p-2 mark-as-read"
                                                                onclick="document.getElementById('mark-read').submit();">
                                                            <i class="fa fa-close"></i></button>
                                                        {{ csrf_field() }}
                                                    </form>
                                                    <div class="row">
                                                        <div class="col-12 p-0">
                                                            <a href="mailto:{{$request->data['email']}}?subject=RE:{{$request->data['subject']}}&body=Hello!">
                                                                Reply to {{$request->data['email']}}
                                                            </a>
                                                            <input type="hidden" name="notif_id" id="notif_id"
                                                                   value="{{$request->id}}">
                                                            <a onclick="submitAlertNotif('{{$request->id}}')">
                                                                {{ csrf_field() }}
                                                                <h4 style="color: #000000;font-weight: lighter">
                                                                    URGENT: <span
                                                                        style="font-weight: bold"> {{$request->data['name']}}</span>
                                                                    requested contact regarding <span
                                                                        style="font-weight: bold">  {{$request->data['reason']}}</span> {{$request->created_at->diffForHumans()}}
                                                                    .
                                                                </h4>
                                                                <p>{{$request->data['content']}}</p>
                                                            </a>
                                                            {{--                                                                </form>--}}
                                                        </div>

                                                    </div>
                                                </div>

                                                @if($loop->last)
                                                    <a href="#" id="mark-all-pet">
                                                        Mark all as read
                                                    </a>
                                                @endif
                                            @empty
                                                There are no new reported posts.
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
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

    function submitMessageNotif(id) {
        document.getElementById(id).submit();
    }

    function submitCommentNotif(id) {
        document.getElementById(id).submit();
    }

    function submitAlertNotif(id) {
        document.getElementById(id).submit();
    }

</script>
