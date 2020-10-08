@extends('layout.master')
@section('title')
    Lost Pet Forum - Post Details
@endsection
@section('content')

    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize"
        async defer></script>

    <header>
        @include('partials.nav')
        @include('partials.message')
        @include('partials.errors')
    </header>
    <div class="wrapper">
    @include('partials.side-nav')

    <!-- Page Content -->
        <div class="container-fluid p-0 post-details">
            <div class="m-4">
                <a href="{{route('posts')}}" style="text-decoration: underline; color: rgba(209,59,22,0.86)">< Pet
                    Forum</a>
                <div class="row">
                    <div class="col-sm-12 col-md-7">
                        {{-- Post Title & Author --}}
                        <h5 class="lead m-0" style="font-weight: bold">{{$post->title}}</h5>
                        <h4>Posted by
                            <a style="font-weight: bold; color: #d13b16"
                               href="{{route('public-profile', ['username' => $post->author])}}">
                                {{$post->author}}
                            </a>
                            {{$post->created_at->diffForHumans()}}</h4>

                    </div>
                    <div class="col-sm-12 col-md-5 text-sm-left text-md-right">
                        <h4 class="lead" style="font-weight: bold; color: #d13b16">{{$post->address_address}}</h4>
                        <p><i class="fa fa-globe" aria-hidden="true"></i> <a style="color: #d13b16;"
                                                                             href="{{route('map-specific', ['id' => $post->id])}}">View
                                on Map</a></p>
                    </div>
                </div>
                <hr>
                {{-- Post Content --}}
                <div class="post-content p-3" style="background-color: white; min-height: 20vw;">
                    {!! $post->content !!}
                </div>
                <div class="row ">
                    {{-- edit post --}}
                    @if(Auth::check())
                        @if(Auth::user()->id == $post->user_id)
                            <a href="{{route('edit-post', ['id' => $post->id ])}}" class="btn btn-light ombre m-1">Edit
                                Post</a>
                            @method('delete')
                            <form method="delete" action="{{route('delete-post')}}">
                                <input name="id" id="id" type="hidden" value="{{$post->id}}">
                                <button class="btn btn-light rev-ombre m-1" type="submit"
                                        onclick="return confirm('Are you sure you want to delete this post?')">Delete
                                    Post
                                </button>
                                {{ csrf_field() }}
                            </form>
                        @else
                            <div class="m-3 row">
                                <div class="text-right" style="justify-content: right">
                                    <button class="mr-2 text-right btn btn-sm ombre" data-toggle="modal"
                                            data-target="#messageModal"> Reply to Poster
                                    </button>
                                </div>
                                {{-- add report button --}}
                                <div class="text-right" style="justify-content: right">
                                    <button class="text-right btn btn-sm rev-ombre" data-toggle="modal"
                                            data-target="#reportModal">Report this Post
                                    </button>
                                    {{ csrf_field() }}
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                <hr>

                @if(Auth::check())
                    <form method="post" action="{{route('post-comment')}}">
                        <div class="form-row" style="margin: 0 auto">
                            <div class="form-group col-md-12">
                                <p class="text-center">Share your thoughts.</p>
                                <textarea rows="6" id="comment" name="comment"
                                          class="form-control my-comment">{!! old('comment') !!}</textarea>
                            </div>
                            <input type="hidden" name="poster_id" id="poster_id" value="{{$post->user_id}}">
                            <input type="hidden" name="id" id="id" value="{{$post->id}}">
                            <button type="submit" class="text-center btn btn-block btn-light ombre">Post Comment
                            </button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                    <hr>
                @endif
            </div>

            <div class="forum-comments m-md-3">
                <h2 class="text-center">Comments</h2>
                {{-- start comments --}}
                @if(count($comments) > 0)
                    @foreach($comments as $comment)
                        {{-- comment --}}
                        <div class="card m-2 p-0" style="border: 2px solid #d13b16">
                            <div class="card-header p-0">
                                <div class="row ml-1">
                                    <div class="col-sm-1 p-0 forum-sm-img p-2">
                                        {{-- User image --}}
                                        <div class="round-img-sm"
                                             style="background-image: url('{{ Storage::disk('s3')->url($comment->owner->profile_image)}}')">
                                        </div>  {{-- end User image --}}
                                    </div>
                                    {{-- Posted By Link --}}
                                    <div class="col-12 col-md-10 p-0 forum-sm-margin">
                                        <h5 class="lead mt-2 ml-2 ml-xl-0">Posted
                                            by
                                            <a style="font-weight: bold;"
                                               href="{{route('public-profile', ['username' => $comment->username])}}">
                                                {{$comment->username}} </a>
                                            {{$comment->created_at->diffForHumans()}}</h5>
                                    </div>  {{-- End Posted by link --}}

                                </div>
                            </div>
                            {{-- Comment Content --}}
                            <div class="card-body">
                                <div class="card-title ml-2">{!! $comment->content !!}</div>
                            </div>  {{-- End comment content --}}
                            @if(Auth::check())
                                @if(Auth::user()->id === $comment->user_id)
                                    @method('delete')

                                    <form action="{{ route('delete-comment') }}" method="post">
                                        <div class="text-left">
                                            <input type="hidden" value="{{$comment->id}}" name="comment_id"
                                                   id="comment_id">

                                            {{-- Delete Button --}}
                                            <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this comment?')"
                                                    class=" ml-4 btn btn-sm btn-light rev-ombre"
                                                    style="color: #d13b16;">Delete
                                            </button>  {{-- End Delete Butotn --}}
                                        </div>
                                        {{ csrf_field() }}
                                    </form>
                                @endif

                                <div class="mt-4 ml-auto" style="margin: 0 auto">
                                    <a style="color: #d13b16; font-weight: bold"
                                       onclick="showReply('{{$comment->id}}')">Reply</a>
                                </div>
                                {{-- Reply form --}}
                                <div class="card-body" id="{{$comment->id}}" style="display: none">
                                    <hr>
                                    <p style="color: #7d7d7d">To {{$comment->username}}...</p>
                                    <form method="Post" action="{{route('post-reply')}}">
                                        <input type="hidden" name="parent_id" id="parent_id" value="{{$comment->id}}">
                                        <input type="hidden" name="post_id" id="post_id" value="{{$post->id}}">
                                        <input type="hidden" name="poster_id" id="poster_id" value="{{$post->user_id}}">
                                        <textarea rows="2" id="reply" name="reply"
                                                  class="form-control my-comment">{!! old('reply') !!}</textarea>
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-block text-center m-1 ombre"
                                                style="font-weight: bold;">Post Reply
                                        </button>
                                    </form>
                                </div>  {{-- End Reply form --}}
                            @endif

                        </div>
                        {{--  replies  --}}
                        @if( $comment->replies )
                            @foreach($comment->replies as $reply)
                                <div class="card m-2 ml-5" style="margin-left: 5%; border: 2px solid #d24000">
                                    <div class="card-header p-0">
                                        <div class="row ml-1">
                                            <div class="col-1 forum-sm-img p-2">
                                                <div class="round-img-sm-reply"
                                                     style="background-image: url('{{ Storage::disk('s3')->url($reply->owner->profile_image)}}')">
                                                </div>
                                            </div>
                                            <div class="col-11 col-md-10 forum-sm-margin">
                                                <h5 class="lead mt-2 p-0 ">Posted
                                                    by
                                                    <a style="font-weight: bold;"
                                                       href="{{route('public-profile', ['username' => $reply->username])}}">
                                                        {{$reply->username}}</a>
                                                    {{$reply->created_at->diffForHumans()}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-title">{!! $reply->content !!}</div>
                                        @if(Auth::check())
                                            @if(Auth::user()->id === $reply->user_id)
                                                @method('delete')
                                                {{-- delete reply --}}
                                                <form action="{{ route('delete-comment') }}" method="post">
                                                    <td class="right">
                                                        <input type="hidden" value="{{$reply->id}}" name="comment_id"
                                                               id="comment_id">
                                                        <button type="submit"
                                                                onclick="return confirm('Are you sure you want to delete this comment?')"
                                                                class=" m-1 btn btn-light rev-ombre">Delete
                                                        </button>
                                                    </td>
                                                    @csrf
                                                </form>  {{-- End delete reply  --}}
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    @endforeach
                    @unless(Auth::check())
                            {{-- In case signed out & comments --}}
                        <div class="container text-center">
                            <p>Join the conversation!</p>
                            <button type="button" class="btn btn-outline-light ombre" data-toggle="modal"
                                    data-target="#signInModal">
                                Sign-in
                            </button>
                            <button type="button" class="btn btn-outline-light rev-ombre" style="color: #d13b16"
                                    data-toggle="modal" data-target="#signUpModal">
                                Sign-up
                            </button>
                        </div>  {{-- End in case signed out & comments --}}
                    @endunless
                @else
                    @if(Auth::check())
                        <p class="text-center">No comments to show.</p>
                    @else
                        {{-- In case signed out & no comments --}}
                        <div class="container text-center">
                            <p>Be the first to reply!</p>
                            <button type="button" class="btn btn-outline-light ombre" data-toggle="modal"
                                    data-target="#signInModal">
                                Sign-in
                            </button>
                            <button type="button" class="btn btn-outline-light ombre" data-toggle="modal"
                                    data-target="#signUpModal">
                                Sign-up
                            </button>
                        </div>  {{-- End in case signed out & no comments  --}}

                    @endif
                @endif
                {{-- Pagination links --}}
                <div class="row">
                    <div class="col pt-3 mr-auto">
                        {{ $comments->links() }}
                    </div>
                </div>

            </div>


        </div>

    </div>
    {{-- New message modal --}}
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Send a Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- sign-in modal body--}}
                <div class="modal-body">
                    @include('partials.create-message')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>   {{-- End new message modal --}}
    {{-- Report Modal --}}
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- sign-in modal body--}}
                <div class="modal-body">
                    @include('partials.report-post')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>  {{-- End Report modal --}}
@endsection
{{-- Reply function --}}
<script>
    function showReply(id) {
        var x = document.getElementById(id);
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
