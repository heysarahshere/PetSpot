@extends('layout.master')
@section('title')
    Lost Pet Forum - Post Details
@endsection
@section('content')

    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize"
        async defer></script>
    <script type="text/javascript">

        function initialize() {

            var map_canvas = document.getElementById('address-map');

            const mapId = "65d9cecb5866ffd4";
            // Initialise the map
            var map_options = {
                center: {lat: {{ $post->address_latitude }}, lng: {{ $post->address_longitude }}},
                zoom: 10,
                mapId: mapId,
            }
            const map = new google.maps.Map(map_canvas, map_options)
            const markers = {};
            const windows = {};
            const contentStrings = {};


                contentStrings[{{ $post->id }}] = '<div id="content">'+
                '<div id="siteNotice">'+
                '</div>'+
                '<h2 id="firstHeading" style="color: #d13b16;"'+
                'class="firstHeading">{{ $post->title }}</h1>'+
                '<div id="bodyContent">'+
                '<p><b>Posted by {{ $post->author }}</b></p>'+
                '<a href="{{route('forum-details', ['id' => $post->id])}}">'+
                'View Post</a> '+
                ''+
                '</div>'+
                '</div>';

            windows[{{ $post->id }}] = new google.maps.InfoWindow({
                content: contentStrings[{{ $post->id }}]
            });

            var lat = parseFloat({{ $post->address_latitude }});
            var lng = parseFloat({{ $post->address_longitude}});
            var location = new google.maps.LatLng(lat, lng);
            markers[{{ $post->id }}] = new google.maps.Marker({
                position: location,
                map: map,
            });



            markers[{{ $post->id }}].addListener('click', function() {
                windows[{{ $post->id }}].open(map, markers[{{ $post->id }}]);
            });

        }
    </script>
    <header>
        @include('partials.nav')
        @include('partials.message')
        @include('partials.errors')
    </header>
    <div class="wrapper">
        <!-- Page Content -->

        <div class="container-fluid m-2" style="background-color: white">
            <a href="{{route('posts')}}" style="text-decoration: underline; color: rgba(209,59,22,0.86)">< Pet Forum</a>

            <div class="row ml-3">
                <div class="col-md-8">
                    <h1>{{ $category }}</h1>
                </div>
                <div class="col-md-4 text-md-right">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-md btn-outline-light ombre-sq">
                            <a href="{{route('lost-map')}}">
                                <input type="radio" name="lost" id="lost" autocomplete="off"> Lost
                            </a>
                        </label>
                        <label class="btn btn-md btn-outline-light ombre-sq">
                            <a href="{{route('found-map')}}">
                                <input type="radio" name="found" id="found" autocomplete="off"> Found
                            </a>
                        </label>
                        <label class="btn btn-md btn-outline-light ombre-sq">
                            <a href="{{route('seeking-map')}}">
                                <input type="radio" name="seeking" id="seeking" autocomplete="off"> Seeking
                            </a>
                        </label>
                        <label class="btn btn-md btn-outline-light ombre-sq">
                            <a href="{{route('map')}}">
                                <input type="radio" name="all" id="all" autocomplete="off"> All
                            </a>
                        </label>
                    </div>
                </div>
            </div>

            <div class="p-1" style="background-color: #d13b16">
            <div id="address-map-container" style="width:100%;height:100vh;">
                <div style="width: 100%; height: 100%" id="address-map"></div>
            </div>
            </div>

        </div>

    </div>
@endsection
