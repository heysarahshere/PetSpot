@extends('layout.master')
@section('title')
    About
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
                <div class="container-fluid mt-3 m-md-4 m-lg-5">
                    <div class="row" style="justify-content: left">
                        <div class="col-8 col-md-5">
                            <img class="petspot-img" src="{{asset('images/pet-spot-about.png')}}" alt="First slide">
                        </div>
                    </div>

                    <h2>Community-Driven Pet Rescue</h2>
                    <hr>
                    <p>

                        Pet Rescue operates as a 501c3 nonprofit organization, and is funded by tax deductible donations, grants and two small
                        government contracts to care for the areas animals.
                        We are a volunteer effort, founded in 1997.
                        We lost our facility by fire in 2009, but we didn’t stop there.
                        After the fire, we started operating out of the Othello Animal Pound.
                        Then in 2015 Adams County provided land to build a new animal facility.
                        We are currently refurbishing and upgrading the facility and have recently added a new isolation room for sick animals.
                        Additionally the computer system has been upgraded, as well as installation of commercial grade washer and dryer.
                        We re-homed over 1,000 dogs and cats in 2017
                        Here are some of the services we offer:
                        Shelter and care for all impounded City of Othello and Adams County dogs
                        Assist Adams County Sheriff’s Dept. in care and housing of animals seized from owners
                        Place dogs, trained at the Coyote Ridge Correction
                        Facility, for adoption
                        Limited emergency medical care for injured dogs
                        Transportation of our dogs for relocation and adoption
                        Assist low income residents to allow them to keep their beloved pets in their homes
                        Discounts for spay/neuter
                        Low cost vaccination clinics
                        Post lost pets on our Facebook page
                        The dedicated individuals who care for the shelter animals and take in all of Othello's strays along with abandoned, neglected, and abused dogs, cats, and horses throughout the county.
                        They rehabilitate them as best they can and place them in loving, caring environments.
                        </p>
                    <hr>
                    <h2 class="strong">At PetSpot, we share a love for all creatures.</h2>
                </div>

    </div>

@endsection
