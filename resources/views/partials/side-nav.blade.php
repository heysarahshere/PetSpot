<nav id="sidebar" class="sidebar">
    @if(Auth::check())
        <ul class="list-unstyled components">
            <li class="active">
                <a href="#profileMenu" data-toggle="collapse" aria-expanded="false"
                   class="dropdown-toggle"><i class="fa fa-user" aria-hidden="true"></i> Account</a>
                <ul class="collapse list-unstyled" id="profileMenu">
                    <li>
                        <a href="{{route('public-profile', ['username' => Auth::user()->userName])}}">Profile</a>
                    </li>
                    <li>
                        <a href="{{route('profile')}}">Account</a>
                    </li>
                    <li>
                        <a href="{{route('notifications')}}">Notifications</a>
                    </li>
                    <li>
                        <a href="{{route('inbox')}}">Inbox</a>
                    </li>
                    <li>
                        <a href="{{route('my-posts')}}">Past Posts</a>
                    </li>
                    <li>
                        <a href="{{route('moderated')}}">Moderated Forums</a>
                    </li>
                    <li>
                        <a href="{{route('donations')}}">Donations</a>
                    </li>
                    <li>
                        <a href="{{route('update-profile')}}">Settings</a>
                    </li>
                </ul>
            </li>

        </ul>

    @endif
    <ul class="list-unstyled components">
        <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"
               class="dropdown-toggle"><i class="fa fa-paw" aria-hidden="true"></i> Animals</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="{{route('adoptable')}}">All</a>
                </li>
                <li>
                    <a href="{{route('dogs')}}">Dogs</a>
                </li>
                <li>
                    <a href="{{route('cats')}}">Cats</a>
                </li>
                <li>
                    <a href="#">Other</a>
                </li>

                @if(Auth::check())
                    <?PHP $user = Auth::user(); ?>
                    @if($user->isAdmin())
                            <li>
                                <a href="{{route('add-pet')}}">ADMIN: Add Pet</a>
                            </li>
                    @endif
                @endif
            </ul>
        </li>
        @if(Auth::check())
            <li>
                <a href="{{route('adopt-form')}}"><i class="fa fa-home" aria-hidden="true"></i> Adopt</a>
            </li>
            <li>
                <a href="{{route('foster-info')}}"><i class="fa fa-heart" aria-hidden="true"></i> Foster</a>
            </li>
        @else
            <li>
                <a href="{{route('login')}}"><i class="fa fa-home" aria-hidden="true"></i> Adopt</a>
            </li>
            <li>
                <a href="{{route('login')}}"><i class="fa fa-heart" aria-hidden="true"></i> Foster</a>
            </li>
        @endif
        <li class="active">
            <div class="refine-search">
                <a href="#searchSubmenu" data-toggle="collapse"
                   aria-expanded="false"
                   class="dropdown-toggle"><i class="fa fa-search" aria-hidden="true"></i> Pet Search</a>
                <ul class="collapse list-unstyled text-center" id="searchSubmenu">
                    <form action="{{route('refine-pet-search')}}" method="post">
                        {{-- age --}}
                        <h5 class="pt-2">Age:</h5>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <input type="hidden" name="age" id="age" value="">
                            <label class="btn btn-sm btn-outline-light rev-ombre" onclick="setAge(1)">
                                <input type="radio" autocomplete="off"> Young
                            </label>
                            <label class="btn btn-sm btn-outline-light rev-ombre" onclick="setAge(2)">
                                <input type="radio" name="options" id="adult" autocomplete="off"> Adult
                            </label>
                            <label class="btn btn-sm btn-outline-light rev-ombre" onclick="setAge(3)">
                                <input type="radio" name="senior" id="senior" autocomplete="off"> Senior
                            </label>
                        </div>
                        {{-- species --}}
                        <h5 class="m-0 pt-2">Species:</h5>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <input type="hidden" name="species" id="species" value="">
                            <label class="btn btn-sm btn-outline-light rev-ombre" onclick="setSpecies(1)">
                                <input type="radio" name="cat" id="cat"> Cats
                            </label>
                            <label class="btn btn-sm btn-outline-light rev-ombre" onclick="setSpecies(2)">
                                <input type="radio" name="dog" id="dog"> Dogs
                            </label>
                        </div>
                        {{-- gender --}}
                        <h5 class="m-0 pt-2">Gender:</h5>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <input type="hidden" name="gender" id="gender" value="">
                            <label class="btn btn-sm btn-outline-light rev-ombre" onclick="setGender(1)">
                                <input type="radio" name="female" id="female"> Female
                            </label>
                            <label class="btn btn-sm btn-outline-light rev-ombre" onclick="setGender(2)">
                                <input type="radio" name="male" id="male"> Male
                            </label>
                        </div>
                        {{-- fur --}}
                        <h5 class="m-0 pt-2">Fur Length:</h5>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <input type="hidden" name="fur" id="fur" value="">
                            <label class="btn btn-sm btn-outline-light rev-ombre" onclick="setFur(1)">
                                <input type="radio" name="short" id="short" autocomplete="off"> Short
                            </label>
                            <label class="btn btn-sm btn-outline-light rev-ombre" onclick="setFur(2)">
                                <input type="radio" name="medium" id="medium" autocomplete="off"> Medium
                            </label>
                            <label class="btn btn-sm btn-outline-light rev-ombre" onclick="setFur(3)">
                                <input type="radio" name="long" id="long" autocomplete="off"> Long
                            </label>
                        </div>
                        <button class="btn btn-outline-light ombre my-3" style="background-color: white">Search</button>
                        {{ csrf_field() }}
                    </form>
                </ul>
            </div>
        </li>
    </ul>
    {{--      forum      --}}
    <ul class="side-nav list-unstyled components">
        <li class="active">
            <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false"
               class="dropdown-toggle"><i class="fa fa-comments" aria-hidden="true"></i> Forum Topics</a>
            <ul class="collapse list-unstyled" id="homeSubmenu2">
                <li>
                    <a href="{{route('general')}}">General</a>
                </li>
                <li>
                    <a href="{{route('lost')}}">Lost</a>
                </li>
                <li>
                    <a href="{{route('found')}}">Found</a>
                </li>
                <li>
                    <a href="{{route('seeking')}}">Seeking</a>
                </li>
                <li>
                    <a href="{{route('posts')}}">All</a>
                </li>
            </ul>
        </li>
        @if(Auth::check())
            <li>
                <a href="{{route('post-new')}}"><i class="fa fa-plus" aria-hidden="true"></i> Create Post</a>
            </li>
        @else
            <li>
                <a href="{{route('login')}}"><i class="fa fa-plus" aria-hidden="true"></i> Create Post</a>
            </li>
        @endif
        <li>
            <a href="{{route('map')}}"><i class="fa fa-globe" aria-hidden="true"></i> Map View</a>
        </li>
        <li>
            <a href="{{route('create-alert')}}"><i class="fa fa-bell" aria-hidden="true"></i> Setup Alert</a>
        </li>
    </ul>

        <ul class="side-nav list-unstyled components">
            <li>
                <a href="{{route('contact')}}"><i class="fa fa-address-card" aria-hidden="true"></i> Contact</a>
            </li>
        </ul>

</nav>

<script type="text/javascript">
    function setSpecies(num) {
        if(num === 1){
            document.getElementById('species').value = "Cat";
        } else if(num === 2){
            document.getElementById('species').value = "Dog";
        } else {
            document.getElementById('species').value = "";
        }
    }
    function setAge(num) {
        if(num === 1){
            document.getElementById('age').value = "young";
        } else if(num === 2){
            document.getElementById('age').value = "adult";
        } else if(num === 3){
            document.getElementById('age').value = "senior";
        } else {
            document.getElementById('age').value = "";
        }
    }
    function setGender(num) {
        if(num === 1){
            document.getElementById('gender').value = "Female";
        } else if(num === 2){
            document.getElementById('gender').value = "Male";
        }  else {
            document.getElementById('gender').value = "";
        }
    }
    function setFur(num) {
            document.getElementById('fur').value = num;
    }
</script>
