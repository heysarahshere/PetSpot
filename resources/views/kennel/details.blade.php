@extends('layout.master')
@section('title')
    Pet Profile - {{$pet->name}}
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
        <div class="container-fluid pet-details m-3" style="width: 100%">
            {{--  use a back route instead --}}
            <a href="{{route('adoptable')}}" style="text-decoration: underline; color: rgba(209,59,22,0.86)">< Adoptable
                Pets</a>
            <div class="row" style="background-color: white">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 p-sm-2 p-md-5">
                    @if($pet->status == "Available")
                        @if(Auth::check())
                            <div class="row mr-1 text-right float-right">
                                <button class="btn ombre mt-2 mt-sm-5"><a
                                        href="{{route('get-apply', ['name' => $pet->name])}}">Apply for Adoption</a>
                                </button>
                            </div>
                            @else
                            <div class="row mr-1 text-right float-right">
                                <button class="btn ombre mt-2 mt-sm-5"><a
                                        href="{{route('login')}}">Apply for Adoption</a>
                                </button>
                            </div>
                        @endif
                    @endif
                    <div class="p-2">
                        <p>{{$pet->status}}</p>
                        <h1>{{$pet->name}}</h1>
                        <h2>{{$pet->gender}} {{$pet->breed}}
                            @if($pet->age === "young" && $pet->species === "Cat")
                                Kitten
                            @elseif($pet->age === "young" && $pet->species === "Dog")
                                Puppy
                            @else
                                {{ $pet->age }}
                            @endif
                        </h2>
                        {{-- change phrasing later --}}
                        <p>I am a {{$pet->size}} breed, and I currently weigh
                            about {{$pet->weight}} pounds. My fur is {{$fur_length}}.</p>
                        <hr>
                        <p>Description: {{$pet->description}}</p>
                        <hr>
                        <h2>Traits:</h2>
                        <div class="container pet-traits">
                            <div class="btn btn-light ">{{$pet_traits->friendly ?? ""}}</div>
                            <div class="btn btn-light ">{{$pet_traits->calm ?? ""}}</div>
                            <div class="btn btn-light ">{{$pet_traits->energetic ?? ""}}</div>
                            <div class="btn btn-light ">{{$pet_traits->special_needs ?? ""}}</div>
                            <div class="btn btn-light ">{{$pet_traits->good_with_kids ?? ""}}</div>
                            <div class="btn btn-light ">{{$pet_traits->drools ?? ""}}</div>
                            <div class="btn btn-light ">{{$pet_traits->vocal ?? ""}}</div>
                            <div class="btn btn-light ">{{$pet_traits->escape_artist ?? ""}}</div>
                            <div class="btn btn-light ">{{$pet_traits->novice_owner_ok ?? ""}}</div>
                            <div class="btn btn-light ">{{$pet_traits->aggressive_toward_humans ?? ""}}</div>
                            <div class="btn btn-light ">{{$pet_traits->aggressive_toward_kids ?? ""}}</div>
                            <div class="btn btn-light ">{{$pet_traits->aggressive_toward_cats ?? ""}}</div>
                            <div class="btn btn-light ">{{$pet_traits->aggressive_toward_dogs ?? ""}}</div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 ml-sm-4 ml-xl-0 p-3">
                    <div class="row" style="justify-content: center">
                        <div class="col-sm-9">
                            <img class="big-featured big m-0 p-0" style="height: auto;width: 100%;" id="big-featured"
                                 src="{{ Storage::disk('s3')->url($pet->image1_url) }}">
                        </div>
                        <div class="col-xs-10 col-sm-2">
                            <div class="hover13 d-flex row">
                                <div class="col-xs-4 ">
                                    <figure><img id="thumb" class="thumb p-1 image-fluid"
                                                 src="{{ Storage::disk('s3')->url($pet->image1_url) }}"
                                                 onclick="swapImage(this.id);"></figure>
                                </div>
                                <div class="col-xs-4 col-xm-12">
                                    <figure><img id="thumb2" class="thumb p-1 image-fluid"
                                                 src="{{ Storage::disk('s3')->url($pet->image2_url) }}"
                                                 onclick="swapImage(this.id);"></figure>
                                </div>
                                <div class="col-xs-4 col-xm-12">
                                    <figure><img id="thumb3" class="thumb p-1 image-fluid"
                                                 src="{{ Storage::disk('s3')->url($pet->image3_url) }}"
                                                 onclick="swapImage(this.id);"></figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                @if(Auth::check())
                    <?PHP $user = Auth::user(); ?>
                    @if($user->isAdmin())
                        <div class="row ml-2 mt-3 text-left float-left">
                            <a href="{{route('update-pet', ['id' => $pet->id])}}"
                               class="btn btn-outline-light ombre m-1">Edit Pet</a>
                            <form action="{{ route('delete-pet', ['id' => $pet->id]) }}" method="POST">
                                <td class="right">
                                    <input type="hidden" value="{{$pet->id}}">
                                    <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this pet?')"
                                            class=" m-1 btn btn-light rev-ombre">Delete Pet
                                    </button>
                                </td>
                                @csrf
                            </form>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function swapImage(id) {
            if (id === "thumb3") {
                document.getElementById("big-featured").setAttribute('src', '{{ Storage::disk('s3')->url($pet->image3_url) }}');
            } else if (id === "thumb2") {
                document.getElementById("big-featured").setAttribute('src', '{{ Storage::disk('s3')->url($pet->image2_url) }}');
            } else {
                document.getElementById("big-featured").setAttribute('src', '{{ Storage::disk('s3')->url($pet->image1_url) }}');
            }
        }

        $('nav-refine').click(function (e) {
            e.preventDefault();
            var radio = $(this).find('input[type=radio]');
            if (radio.is(':checked')) {
                radio.prop('checked', false);
            } else {
                radio.prop('checked', true);
            }
        });
    </script>
@endsection
