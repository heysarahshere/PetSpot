@extends('layout.master')
@section('title')
    {{ $category }} Forum
    {{--    if else here --}}
@endsection
@section('content')

    <header>
        @include('partials.nav')
        @include('partials.message')
        @include('partials.errors')
    </header>
    <div class="wrapper" style="position: relative">
        <!-- Sidebar -->
    @include('partials.side-nav')

    <!-- Page Content -->
        <div class="forum-cards m-3 p-0">
            <p class=" ml-sm-1 ml-md-3"><i class="fa fa-globe" aria-hidden="true"></i> <a style="color: #d13b16;" href="{{route('map')}}">View Posts on Map</a></p>
            <div class="row search-bar m-2">
                <div class="col">
                    <h1 class="viewing ml-sm-0 ml-md-2" style="font-weight: lighter">Viewing {{ $category }} Posts</h1>
                    @isset($narrowed_search)
                        Searched within {{$narrowed_search}}. <a style="font-weight: bold" href="{{route('posts')}}">Click here</a> to start searching all posts.</h3>
                    @endisset
                </div>

                <div class="ml-auto col-md-5">
                    <form action="{{route('search')}}" method="POST" role="search">
                        <div class="row" style="justify-content: center">
                            <input type="hidden" name="search_category" id="search_category" value="{{ $page ?? '' }}">
                            <input name="q" id="q" type="text" style="width: 85%" placeholder="search..." value="{{ $q ?? '' }}">
                            <button style="width: 15%" class="btn btn-md btn-dark float-right" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
            <hr>
            @if($posts->count() > 0)
                @foreach($posts as $post)
                    @include('partials.cards.forum-card')
                    @if($loop->last)
                        <div>
                        @if(Auth::check())
                            <?PHP $user = Auth::user(); ?>
                            @if($user->isAdmin())
                                <div class="col pt-3 mr-auto text-left">
                                    <a href="{{route('post-new')}}" class="btn btn-outline-light ombre">Post to Forum</a>
                                </div>
                            @endif
                        @else
                            <p class="mr-3 mt-3">Please <a style="color: #d13b16" href="{{route('login')}}">log in</a> or <a  style="color: #d13b16" href="{{route('sign-up')}}">create an
                                    account</a> to join the discussion.</p>
                        @endif
                    </div>
                        @endif
                @endforeach
            @else
                <div class="col-md-12">Nothing to show.</div>
            @endif
            <div class="row">
                <div class="col-12 col-sm-6 pt-3 mr-auto">
                    {{ $posts->appends(\Request::except('page'))->onEachSide(2)->links() }}
                </div>

            </div>
            <div class="fixed-button">
                <a href="{{route('post-new')}}" class="btn btn-lg btn-light ombre" ><i class="fa fa-plus p-1" aria-hidden="true"></i></a>
            </div>
        </div>

    </div>
@endsection

<script>
    window.onload = function ready() {
        $('#homeSubmenu2').collapse('show');
    }
</script>
