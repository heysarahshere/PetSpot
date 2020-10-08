@extends('layout.master')
@section('title')
    Edit Profile - {{$user->firstName}} {{$user->lastName}}
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
{{--        @method('put')--}}
            <form  class="container-fluid m-5" style="background-color: white" method="post" action="{{route('update-profile-post')}}" enctype="multipart/form-data">
                <div class="row">
                    <div class="new-pet col-sm-12 col-xl-7 py-4 pl-4">

                        <div class="col-md-12">
                            <label for="firstName">First Name</label>
                            <input class="form-control form-control-lg"
                                   id="firstName"
                                   type="text"
                                   name="firstName"
                                   value="{{$user->firstName}}"
                                   placeholder="{{$user->firstName}}">
                            <label for="lastName">Last Name</label>
                            <input class="form-control form-control-lg"
                                   id="lastName"
                                   type="text"
                                   name="lastName"
                                   value="{{$user->lastName}}"
                                   placeholder="{{$user->lastName}}">
                            <label for="userName">Username</label>
                            <input class="form-control form-control-lg"
                                   id="userName"
                                   type="text"
                                   name="userName"
                                   value="{{$user->userName}}"
                                   placeholder="{{$user->userName}}">
                            <label for="email">Email</label>
                            <input class="form-control form-control-lg"
                                   id="email"
                                   type="text"
                                   name="email"
                                   value="{{$user->email}}"
                                   placeholder="{{$user->email}}">
                            <label for="bio">Bio</label>
                            <textarea rows="3" id="bio" name="bio"
                                      class="form-control my-comment">{!! $user->bio !!}</textarea>
                        </div>

                    </div>
                    <div class="col-sm-12 col-xl-5 p-2 pt-3">
                        <div class="row">
                            <div class="col-sm-9" style="justify-content: center; margin: 0 auto;">
                            <img style="width: 100%; height: auto" id="output" src="{{ Storage::disk('s3')->url($user->profile_image) }}">
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-10" style="justify-content: center; margin: 0 auto;">
                                <div id="upload1"  class="custom-file col-md-12 col-lg-12 py-2">
                                    <input type="file" class="custom-file-input" id="profile_image" name="profile_image" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                    <label class="custom-file-label" for="profile_image">Choose image...</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-light ombre float-right" type="submit">Update Profile</button>
                <button class="btn btn-light rev-ombre float-right" type="reset">Clear</button>
                {{ csrf_field() }}
            </form>

        </div>
    </div>
    <script type="text/javascript">

        document.querySelector('.custom-file-input').addEventListener('change',function(e){
            var fileName = document.getElementById("profile_image").files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });

        // function showUploader() {
        //     // Get the checkbox
        //     var checkBox = document.getElementById("add_image");
        //     // Get the output text
        //     var upload = document.getElementById("upload1");
        //
        //     if (checkBox.checked === true){
        //         upload.style.display = "block";
        //     } else {
        //         upload.style.display = "none";
        //     }
        //
        // }
    </script>
@endsection
