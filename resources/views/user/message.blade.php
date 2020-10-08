@extends('layout.master')
@section('title')

    @if(Auth::check())
        <?PHP $user = Auth::user(); ?>
        Messages - {{$user->firstName}} {{$user->lastName}}
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
        @if(Auth::user()->id === $thread->sender_id || Auth::user()->id === $thread->receiver_id )
            <?PHP $user = Auth::user(); ?>
            <div class="wrapper">
                <!-- Sidebar -->
            @include('partials.side-nav')

            <!-- Page Content -->

                <div class="container-fluid mb-3 mt-0 m-0 m-md-2 m-lg-4 profile">

                    <div class="row ml-md-2 my-3 text-center">
                        <h2 class="ml-3 mt-3">Thread: {{$thread->subject}}</h2>
                    </div>
                    <div class="row">
                        <div class="col-12 infinite-scroll">
                            @forelse($messages as $message)
                                    {{--  end hide for sender --}}
                                @if($message->owner->id === Auth::user()->id)
                                    @if(Auth::user()->id === $thread->receiver_id)
                                            <div class="col-11 ml-auto">
                                                <div class="alert"
                                                     style="position: relative; background-color: rgba(255,255,255,0.71)"
                                                     role="alert">
                                                    <div class="row">
                                                        <div class="col-2 col-sm-2 col-xl-1 pr-0">

                                                            <div class="round-img-sm hide-sm p-0"
                                                                 style="background-image: url('{{ Storage::disk('s3')->url($message->owner->profile_image)}}')">
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-9 col-xl-10 ml-2 messages">
                                                            <div class="row">

                                                                <p style="color: #000000">{{$message->owner->userName}}
                                                                    says...</p>
                                                                <p class="lead float-right ml-auto">{{$message->created_at->diffForHumans()}}</p>
                                                            </div>
                                                            <div>{!! $message->message !!}</div>
                                                        </div>
                                                        <button class="btn btn-sm"
                                                                style="position: absolute; right: 2px; top: 2px;"
                                                                onclick="openModal('{{$message->id}}','{{$thread->id}}')">
                                                            <i class="fa fa-close"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                    @else
                                            <div class="col-11 ml-auto">
                                                <div class="alert"
                                                     style="position: relative; background-color: rgba(255,255,255,0.71)"
                                                     role="alert">
                                                    <div class="row">
                                                        <div class="col-2 col-sm-2 col-xl-1 pr-0">

                                                            <div class="round-img-sm hide-sm p-0"
                                                                 style="background-image: url('{{ Storage::disk('s3')->url($message->owner->profile_image)}}')">
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-9 col-xl-10 ml-2 messages">
                                                            <div class="row">

                                                                <p style="color: #000000">{{$message->owner->userName}}
                                                                    says...</p>
                                                                <p class="lead float-right ml-auto">{{$message->created_at->diffForHumans()}}</p>
                                                            </div>
                                                            <div>{!! $message->message !!}</div>
                                                        </div>
                                                        <button class="btn btn-sm"
                                                                style="position: absolute; right: 2px; top: 2px;"
                                                                onclick="openModal('{{$message->id}}','{{$thread->id}}')">
                                                            <i class="fa fa-close"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                        @endif
                        @else
                                <div class="col-11 mr-auto">
                                    <div class="alert" style="background-color: rgba(255,255,255,0.71)"
                                         role="alert">
                                        <div class="row">
                                            <div class="col-2 col-sm-2 col-xl-1 pr-0">
                                                <div class="round-img-sm hide-sm"
                                                     style="background-image: url('{{ Storage::disk('s3')->url($message->owner->profile_image)}}')">
                                                </div>
                                                {{--                                                    <img class="hide-sm round m-2 p-0" style="width: 90%; height: auto;"--}}
                                                {{--                                                         id="big-featured"--}}
                                                {{--                                                         src="{{ Storage::disk('s3')->url($message->owner->profile_image) }}">--}}
                                            </div>
                                            <div class="col-12 col-sm-9 col-xl-10 ml-2">
                                                <div class="row">
                                                    <p style="color: #d13b16">{{$message->owner->userName}}
                                                        says...</p>
                                                    <p class="lead float-right ml-auto">{{$message->created_at->diffForHumans()}}</p>
                                                </div>
                                                <div>{!! $message->message !!}</div>
                                            </div>

                                            <button class="btn btn-sm"
                                                    style="position: absolute; right: 2px; top: 2px;"
                                                    onclick="openModal('{{$message->id}}','{{$thread->id}}')"><i
                                                    class="fa fa-close"></i></button>

                                        </div>
                                    </div>
                                </div>
                        @endif
                        @empty
                            There are no new messages.
{{--  end hide for sender --}}
                        @endforelse
                        {{ $messages->links() }}
                        <form method="Post" action="{{route('message-reply')}}">
                            <input type="hidden" name="thread_id" id="parent_id" value="{{$thread->id}}">
                            <textarea rows="2" id="reply" name="reply"
                                      class="form-control my-comment">{!! old('reply') !!}</textarea>
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-block text-center m-1 ombre"
                                    style="font-weight: bold;">Post Reply
                            </button>
                        </form>
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
                    <h1>Oops, it looks like you're not part of this conversation.</h1>
                    <h3>Try logging into a different account. You weren't trying to eavesdrop, were you?</h3>
                    <hr>
                    <form method="POST" action="{{route('sign-out')}}">
                        <li class="nav-link">
                            <button onclick="return confirm('Are you sure you want to delete this entire thread?')"
                                    class="btn btn-light rev-ombre" type="submit">Sign-out
                            </button>{{ csrf_field() }}</li>
                    </form>
                </div>
            </div>  <!-- end wrapper -->

        @endif
    @endif
    <div class="modal fade" id="deleteMessageModal" tabindex="-1" role="dialog"
         aria-labelledby="deleteMessageModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {{-- sign-in modal body--}}
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    @include('partials.delete-message-modal')
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="/js/jquery.jscroll.min.js"></script>
{{-- MAKE SURE THAT YOU PUT THE CORRECT PATH FOR jquery.jscroll.min.js --}}

<script type="text/javascript">
    $('ul.pagination').hide();
    $(function () {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: '<img class="center-block" src="/images/loading.gif" alt="Loading..." />', // MAKE SURE THAT YOU PUT THE CORRECT IMG PATH
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function () {
                $('ul.pagination').remove();
            }
        });
    });
</script>

<script>
    window.onload = function ready() {
        $('#profileMenu').collapse('show');
    }

    function openModal(message_id, thread_id) {
        document.getElementById("thread_id").value = thread_id;
        document.getElementById("message_id").value = message_id;
        $('#deleteMessageModal').modal('show');
    }
</script>
