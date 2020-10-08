@extends('layout.master')
@section('title')
    Adopt
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
        <div class="container-fluid adopt m-3 ">
            <div class="row search-bar m-1">
                <h1 class="viewing ml-sm-0 ml-md-2" style="font-weight: lighter">Viewing {{ $category }}</h1>

                <div class="ml-auto col-md-5">
                    <form action="{{route('pet-search')}}" method="POST" role="search">
                        <div class="row" style="justify-content: center">
                            <input name="q" id="q" type="text" style="width: 85%" placeholder="search..." value="{{ $q ?? '' }}">
                            <button style="width: 15%" class="btn btn-md btn-dark float-right" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
            <hr>
            <div class="row">
                @foreach($pets as $pet)
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 pt-4">
                        <a href="{{ route('pet-details', ['id' => $pet->id])}}">
                            <div class="card card-hover pet-card" style="position: relative;">
                                <img class="card-img-top" src="{{ Storage::disk('s3')->url($pet->image1_url) }}"
                                     alt="Photo of {{$pet->name}}">
                                <div class="card-body text-left" style="padding: 1rem">
                                    <h3 style="font-size:small;color: #000000; font-weight: bold">{{$pet->breed}}</h3>
                                    <h1>{{$pet->name}}</h1>
                                    <div class="reveal ombre p-2 float-right status-btn"
                                         style="position: absolute; top: 10px; right: 2%">
                                        <p style="color: white; font-weight: lighter">Status: {{$pet->status}}</p>
                                    </div>
                                    <p>{{$pet->gender}},

                                        @if($pet->age === "young" && $pet->species === "Cat")
                                            Kitten
                                        @elseif($pet->age === "young" && $pet->species === "Dog")
                                            Puppy
                                        @else
                                            {{ $pet->age }}
                                        @endif
                                    </p>

                                </div>
                                <div class="card-footer">
                                    <x-small class="text-muted">Updated {{$pet->created_at->diffForHumans()}}</x-small>
                                </div>
                            </div>
                        </a>
                    </div> <!-- col // -->
                @endforeach
                @unless(count($pets) > 0)
                    <div class="ml-5">
                        <h2>Sorry, no matching pets were found.</h2>
                        <p>Please try a different search.</p>
                    </div>
                @endunless
            </div> {{-- end row --}}
            <div class="row" style="position: relative">
                <div class="col pt-3 mr-auto">
                    {{ $pets->appends(\Request::except('page'))->onEachSide(2)->links() }}
                </div>
            </div>
            @if(Auth::check())
                <?PHP $user = Auth::user(); ?>
                @if($user->isAdmin())
                    <div class="fixed-button" >
                        <a href="{{route('add-pet')}}" class="btn btn-lg btn-light ombre" ><i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
                @endif
            @endif
        </div>
    </div>

@endsection

<script>
    window.onload = function ready() {
            $('#searchSubmenu').collapse('show');
    }
</script>
