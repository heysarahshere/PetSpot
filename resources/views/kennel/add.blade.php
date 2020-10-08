@extends('layout.master')
@section('title')
    Add Pet
@endsection
@section('content')

    <header>
        @include('partials.nav')
        @include('partials.errors')
        @include('partials.message')
    </header>
    <div class="wrapper">

        <!-- Sidebar -->
    @include('partials.side-nav')

    <!-- Page Content -->
        <div class="container-fluid">
            <form method="POST" action="{{route('add-pet-post')}}" enctype="multipart/form-data">
                <div class="row">
                    <div class="new-pet col-sm-12 col-xl-7 py-4 pl-4">
                        <h1>Add Pet</h1>
                        <hr>
                        <h2>Details</h2>

                        <div class="form-row ml-1 mb-3">
                            <div class="col-md-9">
                                <input class="form-control form-control-lg"
                                       id="name"
                                       type="text"
                                       name="name"
                                       placeholder="Name"
                                       value="{{ old('name') }}">
                            </div>
                            <div class="col-md-3">
                                <select class="form-control form-control-lg" id="status" name="status">
                                    <option selected disabled value="">Status...</option>
                                    <option>Available</option>
                                    <option>Holding</option>
                                    <option>Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row ml-1">
                            <div class="col-md-4 mb-3">
                                <select class="form-control form-control-lg" id="age"  name="age">
                                    <option selected disabled value="">Age...</option>
                                    <option>Young</option>
                                    <option>Adult</option>
                                    <option>Senior</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <select class="form-control form-control-lg" id="gender" name="gender">
                                    <option selected disabled value="">Gender...</option>
                                    <option>Female</option>
                                    <option>Male</option>
                                </select>
                            </div>
                            <div class="input-group col-md-4 mb-3">
                                <input class="form-control form-control-lg"
                                       id="weight"
                                       type="text"
                                       name="weight"
                                       placeholder="Weight"
                                       value="{{ old('weight') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">.lbs</span>
                                </div>
                            </div>
                        </div>


                        <div class="form-row ml-1">
                            <div class="col-md-3 mb-3">
                                <select class="form-control form-control-lg" id="species" name="species">
                                    <option selected disabled value="">Species...</option>
                                    <option>Cat</option>
                                    <option>Dog</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input class="form-control form-control-lg"
                                       id="breed"
                                       type="text"
                                       name="breed"
                                       placeholder="Breed"
                                       value="{{ old('breed') }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <select class="form-control form-control-lg" id="size" name="size">
                                    <option selected disabled value="">Breed Size...</option>
                                    <option>small</option>
                                    <option>medium</option>
                                    <option>large</option>
                                </select>
                            </div>
                        </div>
                        <p class="ml-1">Description:</p>
                        <div class="row m-1 mb-3">
                        <textarea class="form-control" id="description" name="description"
                                  placeholder="Loves long walks and chew toys!"
                                  value="{{ old('description') }}"></textarea>
                        </div>
                        <h2>Behavior</h2>
                        <p class="ml-1">Traits:</p>
                        <div class="row ml-1">
                            <label class="btn btn-light  m-1">
                                <input type="checkbox" name="intelligent" id="intelligent" value="true"> Intelligent
                            </label>
                            <label class="btn btn-light  m-1">
                                <input type="checkbox" name="specialNeeds" id="specialNeeds" value="true"> Special Needs
                            </label>
                            <label class="btn btn-light  m-1">
                                <input type="checkbox" name="friendly" id="friendly" value="true"> Friendly
                            </label>
                            <label class="btn btn-light  m-1">
                                <input type="checkbox" name="trained" id="trained" value="true"> Trained
                            </label>
                            <label class="btn btn-light  m-1">
                                <input type="checkbox" name="noviceOwnerOk" id="noviceOwnerOk" value="true"> Novice Owner OK
                            </label>
                            <label class="btn btn-light  m-1">
                                <input type="checkbox" name="energetic" id="energetic" value="true"> Energetic
                            </label>
                            <label class="btn btn-light  m-1">
                                <input type="checkbox" name="goodWithKids" id="goodWithKids" value="true"> Good with Kids
                            </label>
                            <label class="btn btn-light  m-1">
                                <input type="checkbox" name="escapeArtist" id="escapeArtist" value="true"> Escape-Artist
                            </label>
                            <label class="btn btn-light m-1">
                                <input type="checkbox" name="calm" id="calm" value="true"> Calm
                            </label>
                            <label class="btn btn-light  m-1">
                                <input type="checkbox" name="drools" id="drools" value="true"> Drools
                            </label>
                            <label class="btn btn-light  m-1">
                                <input type="checkbox" name="vocal" id="vocal" value="true"> Vocal
                            </label>
                        </div>
                        <p class="ml-1">May be aggressive toward:</p>
                        <div class="row ml-1">
                            <label class="btn btn-light  m-1">
                                <input type="checkbox" name="aggDogs" id="aggDogs" value="true"> Dogs
                            </label>
                            <label class="btn btn-light  m-1">
                                <input type="checkbox" name="aggCats" id="aggCats" value="true"> Cats
                            </label>
                            <label class="btn btn-light  m-1">
                                <input type="checkbox" name="aggKids" id="aggKids" value="true"> Children
                            </label>
                            <label class="btn btn-light  m-1">
                                <input type="checkbox" name="aggHumans" id="aggHumans" value="true"> Humans
                            </label>
                        </div>
                        <hr>

                    </div>


                    <div class="upload-pet col-sm-12 col-xl-5 p-2 pt-3">
                        <div class="row">
                            <div class="col-sm-9" style="justify-content: center; margin: 0 auto;">
                                <img style="max-height: 100%" id="output" src="{{ Storage::disk('s3')->url('empty_dog.jpg') }}">
                            </div>
                        </div>
                        <div class="card-body">

                            <label class="btn btn-light  m-1">
                                <input type="checkbox" name="add_image1" id="add_image1" value="true" onclick="showUploader(1)"> Add Image 1
                            </label>
                            <div style="display: none" id="upload1"  class="custom-file col-md-12 col-lg-12 pb-2">
                                <input type="file" class="custom-file-input" id="image1" name="image1" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                <label class="custom-file-label" for="image1">Choose image 1...</label>
                            </div>

                            <label class="btn btn-light  m-1">
                                <input type="checkbox" name="add_image2" id="add_image2" value="true" onclick="showUploader(2)"> Add Image 2
                            </label>
                            <div style="display: none"  id="upload2" class="custom-file col-md-12 col-lg-12 pb-2">
                                <input type="file" class="custom-file-input2" id="image2" name="image2" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                <label class="custom-file-label" for="image2">Choose image 2...</label>
                            </div>

                            <label class="btn btn-light  m-1">
                                <input type="checkbox" name="add_image3" id="add_image3" value="true"  onclick="showUploader(3)"> Add Image 3
                            </label>
                            <div style="display: none" id="upload3" class="custom-file col-md-12 col-lg-12 pb-2">
                                <input type="file" class="custom-file-input3" id="image3" name="image3" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                <label class="custom-file-label" for="image3">Choose image 3...</label>
                            </div>


                            <p>Fur Length:</p>
                            <div class="slidecontainer mt-1">
                                <input class="slider" type="range" id="furInput" name="furInput" min="0" max="2" value="0"
                                       oninput="setFurLevel(this.value)">
                                <output id="furLevel" name="furLevel" for="furInput"></output>
                            </div>
                            <p>Shed Level:</p>
                            <div class="slidecontainer mt-1">
                                <input class="slider" type="range" id="shedInput" name="shedInput" min="0" max="4" value="0"
                                       oninput="setShedLevel(this.value)">
                                <output id="shedLevel" name="shedLevel" for="shedInput"></output>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group pt-3 ml-5">
                    <button type="submit" class="btn btn-light ombre">Post Pet</button>
                    <button type="reset" class="btn btn-light rev-ombre"><a href="{{route('add-pet')}}">Clear</a></button>
                </div>
                {{ csrf_field() }}
            </form>

        </div>
    </div>
    <script type="text/javascript">
        function setShedLevel(value) {
            if (value === "0") {
                document.getElementById("shedLevel").value = "No Shedding";
            } else if (value === "1") {
                document.getElementById("shedLevel").value = "Low Shedding";
            } else if (value === "2") {
                document.getElementById("shedLevel").value = "Moderate Shedding";
            } else if (value === "3") {
                document.getElementById("shedLevel").value = "High Shedding";
            } else {
                document.getElementById("shedLevel").value = "Extreme Shedding";
            }
        }
        function setFurLevel(value) {
            if (value === "0") {
                document.getElementById("furLevel").value = "Short";
            } else if (value === "1") {
                document.getElementById("furLevel").value = "Medium";
            } else if (value === "2") {
                document.getElementById("furLevel").value = "Long";
            } else {
                document.getElementById("furLevel").value = "Extra Long";
            }
        }

        // image preview script
        document.querySelector('.custom-file-input').addEventListener('change',function(e){
            var fileName = document.getElementById("image1").files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
        document.querySelector('.custom-file-input2').addEventListener('change',function(e){
            var fileName = document.getElementById("image2").files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
        document.querySelector('.custom-file-input3').addEventListener('change',function(e){
            var fileName = document.getElementById("image3").files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });

        // uploader visibility script
        function showUploader(checkBoxId) {
            if(checkBoxId === 1){
                var checkBox = document.getElementById("add_image1");
                var upload = document.getElementById("upload1");
                if (checkBox.checked === true){
                    upload.style.display = "block";
                } else {
                    upload.style.display = "none";
                }
            }
            if(checkBoxId === 2){
                var checkBox = document.getElementById("add_image2");
                var upload = document.getElementById("upload2");
                if (checkBox.checked === true){
                    upload.style.display = "block";
                } else {
                    upload.style.display = "none";
                }
            }
            if(checkBoxId === 3){
                var checkBox = document.getElementById("add_image3");
                var upload = document.getElementById("upload3");
                if (checkBox.checked === true){
                    upload.style.display = "block";
                } else {
                    upload.style.display = "none";
                }
            }
        }
    </script>
@endsection
