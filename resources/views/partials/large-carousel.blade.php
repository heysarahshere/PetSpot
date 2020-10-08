
<div id="myCarousel" class="carousel slide hide-caro-md" data-ride="carousel" style="vertical-align: bottom">
    <ol class="carousel-indicators" style="vertical-align: bottom">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
    </ol>
    <div class="carousel-inner" style="vertical-align: bottom">
        {{-- Carousel 1 --}}
        <div class="carousel-item active">
            <img class="first-slide" src="{{asset('images/aussie_pano6-lg.png')}}" alt="First slide"
                 style="vertical-align: bottom">
            <div class="container">
                <div class="carousel-caption text-left">
                    <div class="col-sm-8 col-md-9 col-lg-7 mb-10">
                        <h2 class="display-6">PetSpot Animal Rescue</h2>
                        <h1 class="display-3">Help us help them</h1>
                        <p>Operation costs increase as the number of animals increase. Routine operations
                            include animal feeding twice a day,
                            facility cleanliness, health and environment seven days a week.</p>
                        <hr>
                        <button class="btn btn-lg btn-round btn-outline-light ombre"><a
                                href="{{route('donate')}}">Donate</a></button>
                        <button class="btn btn-lg btn-round btn-outline-light rev-ombre"><a
                                href="{{route('foster-info')}}">Foster a Pet</a>
                        </button>
                    </div>
                </div>
            </div>
        </div> {{-- End Carousel 1 --}}
        {{-- Carousel 2 --}}
        <div class="carousel-item">
            <img class="second-slide" src="{{asset('images/cat_pano-lg.png')}}" alt="Second slide"
                 style="vertical-align: bottom">
            <div class="container">
                <div class="carousel-caption text-left">
                    <div class="col-sm-8 col-md-9 col-lg-7 mb-10">
                        <h2 class="display-6 mb-0">PetSpot Animal Rescue</h2>
                        <h1 class="display-3">Finding A Forever-Home</h1>
                        <p>Approximately 6.5 million animals are taken to the shelter every year.
                            Most will not find their forever home. Save a life by adopting.</p>

                        <hr class="m-1">
                        <button class="btn btn-md btn-round btn-outline-light ombre"><a href="{{route('adoptable')}}">Adopt</a></button>
                        <button class="btn btn-md btn-round btn-outline-light rev-ombre"><a href="{{route('foster-info')}}">
                                Foster Info
                            </a> </button>
                    </div>
                </div>
            </div>
        </div> {{-- End Carousel 2 --}}
        {{-- Carousel 3 --}}
        <div class="carousel-item">
            <img class="third-slide" src="{{asset('images/horse-lg.png')}}" alt="Third slide"
                 style="vertical-align: bottom">
            <div class="container">
                <div class="carousel-caption text-left">
                    <div class="col-sm-8 col-md-9 col-lg-7 mb-10">
                        <h2 class="display-6">PetSpot Animal Rescue</h2>
                        <h1 class="display-3">Become a Contributor</h1>
                        <p>Operation costs increase as the number of animals increase. Routine operations
                            include animal feeding twice a day,
                            facility cleanliness, health and environment seven days a week.</p>

                        <hr>
                        <button class="btn btn-round btn-outline-light ombre"><a href="{{route('donate')}}">Donate</a>
                        </button>
                        <button class="btn btn-round btn-outline-light rev-ombre"><a
                                href="https://www.amazon.com/hz/wishlist/ls/146B5UNW6DPOM/ref=cm_go_nav_hz"
                                target="_blank">View Wishlist</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div> {{-- End Carousel 3 --}}
    {{-- Carousel Controls --}}
    <a class="carousel-control-prev" href="#myCarousel"
       role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel"
       role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    {{-- End Carousel Controls --}}
</div>
