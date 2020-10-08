@extends('layout.master')
@section('title')
    Lost Pet Forum
    {{--    if else here --}}
@endsection
@section('content')

    <header>
        @include('partials.nav')
        @include('partials.message')
        @include('partials.errors')
    </header>
    <div class="wrapper">
        <!-- Sidebar -->
    @include('partials.side-nav')

    <!-- Page Content -->
        <div class="m-5 forum-cards" style="width: 100%">
            <div class="mr-auto col-md-5">
                <form action="{{route('search')}}" method="POST" role="search">
                    <input name="q" id="q" type="text" class="col-md-10" placeholder="search...">
                    <button class="btn btn-md btn-dark" type="submit"><i class="fa fa-search"></i></button>
                    {{ csrf_field() }}
                </form>
            </div>
            <div class="row">
                <h1 class=" ml-4" style="font-weight: lighter">Viewing: {{ $category }}</h1>
                <button class="btn btn-outline-light ombre ml-auto" style="height: 50%"><a href="{{route('post-new')}}">Post to Forum</a></button>
            </div>
            <hr>
            @foreach($posts as $post)
                <a href="{{route('forum-details', ['id' => $post->id])}}">
                    <div class="card col-12">
                        <div class="card-body row">
                            <div class="col-sm-12 col-md-7">
                                <h2 class="m-0" style="font-weight: bold">{{$post->title}}</h2>
                                <p >Posted by {{$post->author}} {{$post->created_at->diffForHumans()}}</p>
                            </div>
                            <div class="col-sm-12 col-md-5 text-md-right">
                                <p style="color: #000000">Location:</p>
                                <p style="color: #d13b16">{{$post->city}}, {{$post->state}}</p></div>
                        </div>
                    </div>
                </a>
            @endforeach
            @if($posts->count() < 1)
                <div class="col-md-12">Nothing to show.</div>
            @endif
            <div class="row">
                <div class="col pt-3 mr-auto">
                    {{ $posts->links() }}
                </div>
                <div>
                    @if(Auth::check())
                        <?PHP $user = Auth::user(); ?>
                        @if($user->isAdmin())
                            <div class="col pt-3 ml-auto text-right">
                                <a href="{{route('post-new')}}" class="btn btn-outline-light ombre">Post to Forum</a>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
