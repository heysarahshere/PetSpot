<nav class="navbar navbar-light ombre-nav py-1 upper-nav">
    <a class="hide-md nav-link" href="#"><p style="font-size: small">Contact: (555) 555-5555 </p></a>
    <a class="hide-md nav-link" href="mailto:info@petspot.org?subject=Important!&body=Hi." target="_blank" rel="noopener noreferrer"><p style="font-size: small">info@petspot.org</p></a>
    <ul class="hide-md navbar-nav ml-auto  ml-3 mr-3">
        <li class="nav-item mr-5">
        </li>
    </ul>
    {{--        <a class=" nav-link hide-md" href="#">Subscribe</a>--}}
    @if(Auth::check())
{{--        <p style="color: #d0d0d0"></p>--}}
        <a id="notif_count" href="{{route('notifications')}}">
            {{count(Auth::user()->unreadNotifications)}}
            &nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></a>


<script>
        {{--channel.bind('message-sent', function(data) {--}}
        {{--    if('{{Auth::user()->userName}}' === data.username){--}}
        {{--        // push new list object onto ul??--}}
        {{--        $('#notif_count').value(data.notifications);--}}
        {{--    }--}}
        {{--});--}}
        Echo.channel('private-message-sent')
            .listen('MessageSent', (e) => {
                $('#notif_count').text(e.notifications);
            });

        {{--window.Vue = require('vue');--}}
        {{--Vue.component('vue-notifications', require('./components/Counter.vue'));--}}

        {{--const app = new Vue({--}}
        {{--    el: '#app',--}}
        {{--    created (){--}}
        {{--        Echo.channel('private-message-sent')--}}
        {{--            .listen('MessageSent', (e) => {--}}
        {{--                $('#notif_count').text(e.notifications);--}}
        {{--            });--}}
        {{--    }--}}
        {{--});--}}

        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
</script>




{{--------------------------------------------------------}}
        <ul class="accountDropdown">
        <li class="nav-item dropdown pr-1">
            <a class="nav-link sm-right pl-0 pl-md-2" href="{{route('posts')}}" id="accountDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #ffffff; font-weight: bold">
                {{Auth::user()->userName}} <i class="fa fa-chevron-down"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="accountDropdown">
                <a style="color: #3e3e3e" class="dropdown-item" href="{{route('profile')}}">Account</a>
                <a style="color: #3e3e3e" class="dropdown-item" href="{{route('public-profile', ['username' => Auth::user()->userName])}}">Profile</a>
                <a style="color: #3e3e3e" class="dropdown-item" href="{{route('notifications')}}">Notifications</a>
                <a style="color: #3e3e3e" class="dropdown-item" href="{{route('inbox')}}">Inbox</a>
                <a style="color: #3e3e3e" class="dropdown-item" href="{{route('my-posts')}}">Past Posts</a>
                <a style="color: #3e3e3e" class="dropdown-item" href="{{route('inbox')}}">Inbox</a>
                <a style="color: #3e3e3e" class="dropdown-item" href="{{route('moderated')}}">Moderated Forums</a>
                <a style="color: #3e3e3e" class="dropdown-item" href="{{route('donations')}}">Donations</a>
                <a style="color: #3e3e3e" class="dropdown-item" href="{{route('update-profile')}}">Settings</a>
            </div>
        </li>
        </ul>
        <form method="POST" action="{{route('sign-out')}}">
            <li class="nav-link">
                <button class="btn btn-light rev-ombre" type="submit">Sign-out</button>{{ csrf_field() }}</li>
        </form>
    @else
        {{-- sign in --}}
        <li class="ml-auto nav-link">
            {{-- sign-in modal button--}}
            <button type="button" class="btn btn-outline-light nav-ombre" data-toggle="modal"
                    data-target="#signInModal">
                Sign-in
            </button>
            <div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="signInModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="signInModalLabel">Welcome back!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {{-- sign-in modal body--}}
                        <div class="modal-body">
                            @include('partials.sign-in-modal')
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        {{-- sign up --}}
        <li class="nav-link p-0">
            {{-- sign-up modal button--}}
            <button type="button" class="btn btn-outline-light nav-ombre" data-toggle="modal"
                    data-target="#signUpModal">
                Sign-up
            </button>
            <div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signUpModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="signUpModalLabel">Create an Account</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {{-- sign-in modal body--}}
                        <div class="modal-body">
                            @include('partials.sign-up-modal')
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @endif
    <div class="row hide-md pl-4">
        <a class="nav-link" href="https://www.petspot.org/"><i class="fa fa-globe"></i></a>
        <a class="nav-link" href="https://github.com/heysarahshere"><i class="fa fa-github"></i></a>
        <a class="nav-link" href="#"><i class="fa fa-youtube"></i></a>
        <a class="nav-link" href="https://www.linkedin.com/in/heysarahshere/"><i class="fa fa-linkedin"></i></a>
    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light py-md-3 py-lg-4">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse main-nav ml-3 mr-3" id="navbarSupportedContent">
        <img class="navbar-brand pet-spot-logo hide-sm" src="{{asset('images/petspo-logo.png')}}" alt="PetSpot Logo"
             style="width: 3vw">

        <a class="navbar-brand strong" href="{{route('index')}}"> &nbsp; <span style="font-weight: bold">PetSpot</span>
            | A Spot for Pets</a>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item">
                <a class="nav-link" href="{{route('index')}}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('about')}}">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('blog')}}">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('foster-info')}}">Foster</a>
            </li>
            <li class="nav-item dropdown pr-1">
                <a class="nav-link" href="{{route('adoptable')}}" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Adopt <i class="fa fa-chevron-down"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('dogs')}}">Dogs</a>
                    <a class="dropdown-item" href="{{route('cats')}}">Cats</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('adoptable')}}">All Pets</a>
                </div>
            </li>
            <li class="nav-item dropdown pr-1">
                <a class="nav-link pl-0 pl-md-2" href="{{route('posts')}}" id="forumDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Forum <i class="fa fa-chevron-down"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="forumDropdown">
                    <a class="dropdown-item" href="{{route('posts')}}">All</a>
                    <a class="dropdown-item" href="{{route('lost')}}">Lost</a>
                    <a class="dropdown-item" href="{{route('found')}}">Found</a>
                    <a class="dropdown-item" href="{{route('seeking')}}">Seeking</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('map')}}">Map View</a>
                    <a class="dropdown-item" href="{{route('create-alert')}}">Found Pet Alerts </a>
                </div>
            </li>
            <a class="nav-link btn nav-ombre pl-2 pr-2 m-auto" href="{{route('donate')}}">Donate</a>
        </ul>

    </div>
</nav>

<vue-notifications></vue-notifications>
