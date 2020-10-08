
    <div class="col-md-10 ml-1">
        <h1>Sign Up</h1>
    <form method="POST" action="{{route('sign-up-post')}}">
        <input class="form-control form-control-lg m-2"
               id="email"
               type="text"
               name="email"
               placeholder="Email" required>
        <input class="form-control form-control-lg m-2"
               id="userName"
               type="text"
               name="userName"
               placeholder="Username" required>
        <input class="form-control form-control-lg m-2"
               id="firstName"
               type="text"
               name="firstName"
               placeholder="First Name" required>
        <input class="form-control form-control-lg m-2"
               id="lastName"
               type="text"
               name="lastName"
               placeholder="Last Name" required>
        <input class="form-control form-control-lg m-2"
               id="password"
               type="password"
               name="password"
               placeholder="Password" minlength="6" required>
        <input class="form-control form-control-lg m-2"
               id="password_confirmation"
               type="password"
               name="password_confirmation"
               placeholder="Confirm Password"  minlength="6" required>
        <div class="form-group pt-3">
            <button type="submit" class="btn ombre">Sign up</button>
            <button type="reset" class="btn rev-ombre"><a href="{{route('sign-up')}}">Clear</a></button>
        </div>
        {{ csrf_field() }}
    </form>
        <a data-toggle="modal" data-target="#signInModal" data-dismiss="modal">Already have an account? Sign in.</a>
    </div>
