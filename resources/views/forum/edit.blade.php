@extends('layout.master')
@section('title')
    Pet Forum - New
    {{--    if else here --}}
@endsection
@section('content')

    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize"
        async defer></script>
    <script src="/js/mapInput.js"></script>
    <header>
        @include('partials.nav')
        @include('partials.message')
        @include('partials.errors')
    </header>
    <div class="wrapper">
        <!-- Page Content -->
        <div class="container-fluid mt-4" style="height: 100%; width: 100%">
            @if(Auth::check())
                @if(Auth::user()->id == $post->user_id)
                    <form method="post" action="{{route('put-edit-post', ['id' => $post->id])}}">

                        <div class="row" style="justify-content: center">
                            <div class="col-md-10">

                                <h2>Editing Post as {{ Auth::user()->userName }}</h2>
                                <hr>
                                <div class="form-group">
                                    <div class="row">

                                        <div class="col-sm-8 col-md-8 col-lg-9">
                                            <label for="address_address">Address</label>
                                            <input value="{{$post->address_address}}" type="text" id="address-input"
                                                   name="address_address"
                                                   class="form-control map-input" required>
                                            <input type="hidden" name="address_latitude" id="address-latitude"
                                                   value="0"/>
                                            <input type="hidden" name="address_longitude" id="address-longitude"
                                                   value="0"/>
                                            <input type="hidden" name="state" id="state" value=""/>
                                        </div>
                                        <div class="mt-4 ml-auto" style="margin: 0 auto">
                                            <a class="btn btn-light ombre" onclick="hideMap()">Show/Hide Map</a>
                                        </div>
                                    </div>
                                </div>
                                <div id="address-map-container" style="width:100%;height:50vh; display: flex">
                                    <div style="width: 100%; height: 100%" id="address-map"></div>
                                </div>
                            </div>
                            <div class="col-md-10 mb-4">
                                <div class="form-group">
                                    <hr>
                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-8">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                   value="{{ $post->title }}" required>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label for="category">Category</label>
                                            <select onchange="showOptions(this.value)" name="category" id="category"
                                                    class="form-control">
                                                <option value="{{$post->category}}" selected></option>
                                                <option>Missing Pets</option>
                                                <option>Found Pets</option>
                                                <option>Seeking Pets</option>
                                                <option>General</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="row" id="extra_options" style="display: none">
                                        <div class="col-12 col-md-6 mt-3">
                                            <label for="animal_type">Animal Type:</label>
                                            <select name="type" id="type" class="form-control">
                                                <option value="{{$post->type}}" selected></option>
                                                <option>Cat</option>
                                                <option>Dog</option>
                                                <option>Bird</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6 mt-3"
                                             data-tip="If applicable, enter date pet was lost or found.">
                                            <label for="event_date">Date:</label>
                                            <input value="{{ $post->event_date }}" type="date" id="event_date"
                                                   name="event_date"
                                                   class="form-control">
                                        </div>

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="content">Content</label>
                                        <textarea rows="15" id="content" name="content"
                                                  class="form-control my-editor">{!! $post->content !!}</textarea>
                                    </div>
                                </div>
                                <div class="row ml-auto mr-2">
                                    <button class="btn btn-light ombre mb-3" type="submit">Update Post</button>
                                </div>
                            </div>
                        </div>

                        {{ csrf_field() }}
                    </form>
                @else
                    <div class="container" style="height: 40vh">
                        <h2 class="mt-4">You must be logged in to edit this post.</h2>
                    </div>
                @endif
            @else
                <div class="container" style="height: 40vh">
                    <h2 class="mt-4">You must be logged in to edit this post.</h2>
                </div>
            @endif
        </div>
    </div>

@endsection


<script type="text/javascript">
    function hideMap() {
        var x = document.getElementById("address-map-container");
        if (x.style.display === "none") {
            x.style.display = "flex";
        } else {
            x.style.display = "none";
        }
    }

    function showOptions(value) {
        if (value === "Found Pets") {
            document.getElementById("extra_options").style.display = "flex"
        } else if (value === "Missing Pets") {
            document.getElementById("extra_options").style.display = "flex"
        } else {
            document.getElementById("extra_options").style.display = "none"
        }
    }

</script>
