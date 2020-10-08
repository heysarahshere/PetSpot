@extends('layout.master')
@section('title')
    Home
@endsection
@section('content')

    <header>
        @include('partials.nav')
        @include('partials.message')
        @include('partials.errors')
    </header>

    <section class="home" style="vertical-align: bottom">

        {{-- large carousel --}}
        @include('partials.large-carousel')

        {{-- small/medium carousel --}}
        @include('partials.small-carousel')

        {{-- orange banner image cards --}}
        <div class="container-fluid p-0 orange-row orange-row-img">
            <div class="row">

                {{-- Image 1 --}}
                <div class="col-sm-12 col-md-4 p-sm-1" style="background-color: rgba(209,87,22,0.8)">
                    <div class="py-2 p-sm-2 p-md-4 p-lg-5 text-center col-10" style="margin: 0 auto; color: white">
                        <h2><a href="{{route('donate')}}">Make a Donation</a></h2>
                        <p><i class="fa fa-heart" aria-hidden="true"></i></p>
                        <p>Your generosity provides our animals with food, shelter, and medical treatments. Every little
                            bit counts.</p>
                        <p>Please, consider <a style="color: white; font-weight: bold; text-decoration: underline"
                                               href="{{route('donate')}}">making a donation.</a></p>
                    </div>
                </div> {{-- End Image 1 --}}

                {{-- Image 2 --}}
                <div class="col-sm-12 col-md-4 p-sm-1" style="background-color: rgba(209,59,22,0.8)">
                    <div class="py-2 p-sm-2 p-md-4 p-lg-5 text-center col-10" style="margin: 0 auto; color: white">
                        <h2><a href="{{route('posts')}}">Browse the Forum</a></h2>
                        <p><i class="fa fa-globe" aria-hidden="true"></i></p>
                        <p>Looking for a lost pet or hoping to help someone else find theirs? Our forum contains posts
                            from
                            the National Lost and Found Pets database and is updated daily.</p>
                        <p><a style="color: white; font-weight: bold; text-decoration: underline"
                              href="{{route('posts')}}">View the forum.</a></p>

                    </div>
                </div> {{-- End Image 2 --}}

                {{-- Image 3 --}}
                <div class="col-sm-12 col-md-4" style="background-color: rgba(209,87,22,0.8)">
                    <div class="py-2 p-sm-2 p-md-4 p-lg-5 text-center col-10" style="margin: 0 auto; color: white">
                        <h2><a href="{{route('adoptable')}}">Adopt or Foster</a></h2>
                        <p><i class="fa fa-home" aria-hidden="true"></i></p>
                        <p>Every day, thousands of animals end up in shelters where they may be euthanized. Their only
                            hope is adoption.</p>
                        <p><a style="color: white; font-weight: bold; text-decoration: underline"
                              href="{{route('adoptable')}}">View adoptable animals</a>, or <a
                                style="color: white; font-weight: bold; text-decoration: underline"
                                href="{{route('foster-info')}}">apply to foster</a>.</p>

                    </div>
                </div> {{-- End Image 3 --}}

            </div>
        </div>

        <hr>
        <div class="row" style="justify-content: center">

            <div class="col-9 col-md-6">
                <img class="petspot-img" src="{{asset('images/pet-spot-stories.png')}}" alt="PetSpot Stories">
            </div>
        </div>

        {{-- stories --}}
        <div class="container marketing">
            <hr class="featurette-divider">
            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">Meet Prime,<span class="text-muted"> a kitty recovering from a broken leg.</span>
                    </h2>
                    <p class="lead">Every day, we meet animals like Prime who are broken, homeless, and starving. They
                        deserve
                        a warm bed, food, and care just as much as any other living beings. With your help, we can
                        ensure their
                        continued protection.</p>
                </div>
                <div class="col-md-5">
                    <img class="featurette-image img-fluid mx-auto" src="{{asset('images/noel.jpg')}}" alt="500x500"
                         style="width: 100%; height: auto;"
                         src="{{asset('images/spay.jpg')}}"
                         data-holder-rendered="true">
                </div>
            </div>

            <hr class="featurette-divider">


            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading">Many of these pups will fail to find homes.<span
                            class="text-muted"> Remember to spay and neuter.</span></h2>
                    <p class="lead">Shelters are overwhelmed with litters, especially around the holidays. Don't forget
                        the low cost spay/neuter cat program happening January 11th in Othello, Wa. Spay and neuter
                        before you are overwhelmed with kittens this spring! Call 509-488-5514 for information about
                        signing up.</p>
                </div>
                <div class="col-md-5 order-md-1">
                    <img class="featurette-image img-fluid mx-auto" src="{{asset('images/pups.jpg')}}" alt="500x500"
                         src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22500%22%20height%3D%22500%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20500%20500%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16fcf8dbcb7%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A25pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16fcf8dbcb7%22%3E%3Crect%20width%3D%22500%22%20height%3D%22500%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22185.1171875%22%20y%3D%22261.1%22%3E500x500%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                         data-holder-rendered="true" style="width: 100%; height: auto;">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">Send some prayers!<span
                            class="text-muted"> These pups will need it.</span></h2>
                    <p class="lead"> We got 10 pups in yesterday and at first we thought it would be smooth sailing but
                        this morning we came in and one had passed away. We took another immediately to the vet clinic
                        and we soon lost that pup. Within 30 minutes, we had loaded up the rest for a quick trip over to
                        the vet clinic because another pup looked really bad.
                        Radiographs proved the poor pups had all been eating rocks and other testing found they were
                        also sick with giardia. When they got fed last night the combination of the food with the rocks
                        caused blockage. Now we wait to see if the rocks will pass and we'll keep you posted.</p>
                </div>
                <div class="col-md-5">
                    <img class="featurette-image img-fluid mx-auto" src="{{asset('images/pups2.jpg')}}" alt="500x500"
                         src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22500%22%20height%3D%22500%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20500%20500%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16fcf8dbcb8%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A25pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16fcf8dbcb8%22%3E%3Crect%20width%3D%22500%22%20height%3D%22500%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22185.1171875%22%20y%3D%22261.1%22%3E500x500%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                         data-holder-rendered="true" style="width: 100%; height: auto;">
                </div>
            </div>

            <hr class="featurette-divider">

            <!-- /END THE FEATURETTES -->

        </div>
    </section>
@endsection
