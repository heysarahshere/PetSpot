@extends('layout.master')
@section('title')
    Lost Pet Forum - Map
@endsection
@section('content')

    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize"
        async defer></script>
    <script type="text/javascript">
        setTimeout(
            function initialize() {

                var map_canvas = document.getElementById('address-map');

                const mapId = "65d9cecb5866ffd4";
                // Initialise the map
                var map_options = {
                    center: {lat: 39.8283, lng: -98.5795},
                    zoom: 5,
                    mapId: mapId,
                }

                const map = new google.maps.Map(map_canvas, map_options)
                const markers = {};
                const windows = {};
                const contentStrings = {};
                @foreach($posts as $post)

                    // string for post info
                    contentStrings[{{ $post->id }}] = '<div id="content">' +
                    '<div id="siteNotice">' +
                    '</div>' +
                    '<h2 id="firstHeading" style="color: #d13b16;"' +
                    'class="firstHeading">{{ $post->title }}</h1>' +
                    '<div id="bodyContent">' +
                    '<p><b>Posted by {{ $post->author }}</b></p>' +
                    '<a href="{{route('forum-details', ['id' => $post->id])}}">' +
                    'View Post</a> ' +
                    '' +
                    '</div>' +
                    '</div>';

                windows[{{ $post->id }}] = new google.maps.InfoWindow({
                    content: contentStrings[{{ $post->id }}]
                });

                var lat = parseFloat({{ $post->address_latitude }});
                var lng = parseFloat({{ $post->address_longitude}});
                var location = new google.maps.LatLng(lat, lng);

                // if else to set icon
                var marker_icon = "{{ Storage::disk('s3')->url( $post->type.'-marker.png') }}";

                // create marker with unique id
                markers[{{ $post->id }}] = new google.maps.Marker({
                    position: location,
                    map: map,
                    icon: marker_icon
                });

                // add listener to marker
                markers[{{ $post->id }}].addListener('click', function () {
                    windows[{{ $post->id }}].open(map, markers[{{ $post->id }}]);
                });

                @endforeach
        }, 1000);

        google.maps.event.addDomListener(window, 'page:load', initialize);
    </script>
    <header>
        @include('partials.nav')
        @include('partials.message')
        @include('partials.errors')
    </header>
    <div class="wrapper">
        <!-- Page Content -->

        <div class="container-fluid m-2">
            <a href="{{route('posts')}}" style="text-decoration: underline; color: rgba(209,59,22,0.86)">< Pet Forum</a>

            <div class="row ml-3">
                <div class="col-md-8">
                    <h1>{{ $category }}</h1>
                </div>
                {{-- Map category buttons --}}
                <div class="col-md-4 text-md-right">
                    <div class="btn-group" data-toggle="buttons">
                        <a href="{{route('lost-map')}}">
                            <button class="btn btn-md btn-outline-light ombre-sq">Lost
                            </button>
                        </a>
                        <a href="{{route('found-map')}}">
                            <button class="btn btn-md btn-outline-light ombre-sq">Found
                            </button>
                        </a>
                        <a href="{{route('seeking-map')}}">
                            <button class="btn btn-md btn-outline-light ombre-sq">Seeking
                            </button>
                        </a>
                        <a href="{{route('map')}}">
                            <button class="btn btn-md btn-outline-light ombre-sq">All
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div style="background-color: #d13b16">
                <div id="address-map-container" style="width:100%;height:100vh;">
                    <div style="width: 100%; height: 100%" id="address-map"></div>
                </div>
            </div>

        </div>

    </div>
@endsection

