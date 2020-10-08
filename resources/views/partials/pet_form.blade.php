<div class="row ml-2">
    <div class="new-pet col-sm-10 col-md-7 col-lg-6 p-4">
        <hr>
        <h2>Details</h2>

        <div class="form-row ml-1 mb-3">
            <div class="col-md-9">
                <input class="form-control form-control-lg"
                       id="name"
                       type="text"
                       name="name"
                       value="{{$pet->name}}"
                       placeholder="{{$pet->name}}">
            </div>
            <div class="col-md-3">
                <select class="form-control form-control-lg" id="status" name="status">
                    <option selected value="{{$pet->status}}">{{$pet->status}}</option>
                    <option>Available</option>
                    <option>Holding</option>
                    <option>Pending</option>
                </select>
            </div>
        </div>
        <div class="form-row ml-1">
            <div class="col-md-4 mb-3">
                <select class="form-control form-control-lg" id="age"  name="age">
                    <option selected value="{{$pet->age}}">{{$pet->age}}</option>
                    <option>Young</option>
                    <option>Adult</option>
                    <option>Senior</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <select class="form-control form-control-lg" id="gender" name="gender">
                    <option selected value="{{$pet->gender}}">{{$pet->gender}}</option>
                    <option>Female</option>
                    <option>Male</option>
                </select>
            </div>
            <div class="input-group col-md-4 mb-3">
                <input class="form-control form-control-lg"
                       id="weight"
                       type="text"
                       name="weight"
                       value="{{$pet->weight}}">
                <div class="input-group-append">
                    <span class="input-group-text">.lbs</span>
                </div>
            </div>
        </div>


        <div class="form-row ml-1">
            <div class="col-md-3 mb-3">
                <select class="form-control form-control-lg" id="species" name="species">
                    <option selected value="{{$pet->species}}">{{$pet->species}}</option>
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
                       value="{{$pet->breed}}">
            </div>
            <div class="col-md-3 mb-3">
                <select class="form-control form-control-lg" id="size" name="size">
                    <option selected value="{{$pet->size}}">{{$pet->size}}</option>
                    <option>small</option>
                    <option>medium</option>
                    <option>large</option>
                </select>
            </div>
        </div>
        <p class="ml-1">Description:</p>
        <div class="row ml-1 mb-3">
                        <textarea class="form-control" id="description" name="description"
                                  placeholder="{{$pet->description}}">{{$pet->description}}</textarea>
        </div>
        <h2>Behavior</h2>
        <p class="ml-1">Traits:</p>
        <div class="row ml-1">
            <label class="btn btn-light  m-1">
                <input type="checkbox" name="intelligent" id="intelligent"
                       value="true" {{$pet_traits->intelligent ? "checked" : ""}}> Intelligent
            </label>
            <label class="btn btn-light  m-1">
                <input type="checkbox" name="specialNeeds" id="specialNeeds" value="true" {{$pet_traits->special_needs ? "checked" : ""}}> Special Needs
            </label>
            <label class="btn btn-light  m-1">
                <input type="checkbox" name="friendly" id="friendly" value="true"  {{$pet_traits->friendly ? "checked" : ""}}> Friendly
            </label>
            <label class="btn btn-light  m-1">
                <input type="checkbox" name="trained" id="trained" value="true"  {{$pet_traits->trained ? "checked" : ""}}> Trained
            </label>
            <label class="btn btn-light  m-1">
                <input type="checkbox" name="noviceOwnerOk" id="noviceOwnerOk" value="true"  {{$pet_traits->novice_owner_ok ? "checked" : ""}}> Novice Owner OK
            </label>
            <label class="btn btn-light  m-1">
                <input type="checkbox" name="energetic" id="energetic" value="true"  {{$pet_traits->energetic ? "checked" : ""}}> Energetic
            </label>
            <label class="btn btn-light  m-1">
                <input type="checkbox" name="goodWithKids" id="goodWithKids" value="true"  {{$pet_traits->good_with_kids ? "checked" : ""}}> Good with Kids
            </label>
            <label class="btn btn-light  m-1">
                <input type="checkbox" name="escapeArtist" id="escapeArtist" value="true"   {{$pet_traits->escape_artist ? "checked" : ""}}> Escape-Artist
            </label>
            <label class="btn btn-light m-1">
                <input type="checkbox" name="calm" id="calm" value="true"  {{$pet_traits->calm ? "checked" : ""}}> Calm
            </label>
            <label class="btn btn-light  m-1">
                <input type="checkbox" name="drools" id="drools" value="true"  {{$pet_traits->drools ? "checked" : ""}}> Drools
            </label>
            <label class="btn btn-light  m-1">
                <input type="checkbox" name="vocal" id="vocal" value="true"  {{$pet_traits->vocal ? "checked" : ""}}> Vocal
            </label>
        </div>
        <p class="ml-1">May be aggressive toward:</p>
        <div class="row ml-1">
            <label class="btn btn-light  m-1">
                <input type="checkbox" name="aggDogs" id="aggDogs" value="true" {{$pet_traits->aggressive_toward_dogs ? "checked" : ""}}> Dogs
            </label>
            <label class="btn btn-light  m-1">
                <input type="checkbox" name="aggCats" id="aggCats" value="true" {{$pet_traits->aggressive_toward_cats ? "checked" : ""}}> Cats
            </label>
            <label class="btn btn-light  m-1">
                <input type="checkbox" name="aggKids" id="aggKids" value="true" {{$pet_traits->aggressive_toward_kids ? "checked" : ""}}> Children
            </label>
            <label class="btn btn-light  m-1">
                <input type="checkbox" name="aggHumans" id="aggHumans" value="true" {{$pet_traits->aggressive_toward_humans ? "checked" : ""}}> Humans
            </label>
        </div>
        <hr>

    </div>
    <div class="upload-pet col-sm-10 col-md-5 col-lg-6 p-4">
        <div class="card">
            <div class="card-img-top">
                <img style="max-height: 100%" id="output" src="{{asset('storage/images/kennel/' . $pet->image1_url)}}">
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
                    <input class="slider" type="range" id="furInput" name="furInput" min="0" max="2" value="{{$pet->fur_level}}"
                           oninput="setFurLevel(this.value)">
                    <output id="furLevel" name="furLevel" for="furInput"></output>
                </div>
                <p>Shed Level:</p>
                <div class="slidecontainer mt-1">
                    <input class="slider" type="range" id="shedInput" name="shedInput" min="0" max="4" value="{{$pet->shed_level}}"
                           oninput="setShedLevel(this.value)">
                    <output id="shedLevel" name="shedLevel" for="shedInput"></output>
                </div>
            </div>
        </div>
    </div>
</div>
