<nav id="sidebar">

    <ul class="list-unstyled components">
        <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"
               class="dropdown-toggle">Animals</a>
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
            </ul>
        </li>
        <li>
            <a href="{{route('adopt-form')}}">Adopt</a>
        </li>
        <li>
            <a href="{{route('foster-form')}}">Foster</a>
        </li>
        <li>
            <a href="{{route('foster-form')}}">Profile</a>
        </li>
        <li>
            <a href="#">Contact</a>
        </li>
    </ul>
    {{--      pet search stuff      --}}
    <ul class="side-nav list-unstyled components">

        <li class="active">
            <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false"
               class="dropdown-toggle">Forum Topics</a>
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
        <li>
            <a href="#">New Post</a>
        </li>
        <li>
            <a href="#">Contact</a>
        </li>
    </ul>

    <ul class="side-nav list-unstyled components">
        <li class="active">
            <div class="refine-search">
                <a href="#searchSubmenu" data-toggle="collapse" aria-expanded="false"
                   class="dropdown-toggle">Refine Pet Search</a>
                <ul class="collapse list-unstyled text-center" id="searchSubmenu">
                    <form action="{{route('refine-pet-search')}}" method="post">
                        <h3 class="pt-2">Age:</h3>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-sm btn-outline-light rev-ombre">
                                <input type="radio" name="puppy" id="puppy" autocomplete="off"> Puppy
                            </label>
                            <label class="btn btn-sm btn-outline-light rev-ombre">
                                <input type="radio" name="options" id="adult" autocomplete="off"> Adult
                            </label>
                            <label class="btn btn-sm btn-outline-light rev-ombre">
                                <input type="radio" name="senior" id="senior" autocomplete="off"> Senior
                            </label>
                        </div>
                        {{-- gender --}}
                        <h3 class="m-0 pt-2">Gender:</h3>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-sm btn-outline-light rev-ombre">
                                <input type="radio" name="female" id="female"> Female
                            </label>
                            <label class="btn btn-sm btn-outline-light rev-ombre">
                                <input type="radio" name="male" id="male"> Male
                            </label>
                        </div>
                        {{-- fur --}}
                        <h3 class="m-0 pt-2">Fur Length:</h3>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-sm btn-outline-light rev-ombre">
                                <input type="radio" name="short" id="short" autocomplete="off"> Short
                            </label>
                            <label class="btn btn-sm btn-outline-light rev-ombre">
                                <input type="radio" name="medium" id="medium" autocomplete="off"> Medium
                            </label>
                            <label class="btn btn-sm btn-outline-light rev-ombre">
                                <input type="radio" name="long" id="long" autocomplete="off"> Long
                            </label>
                        </div>
                        <button class="btn btn-light ombre my-3" style="background-color: white">Search</button>
                        {{ csrf_field() }}
                    </form>

                </ul>


            </div>
        </li>
    </ul>
</nav>
