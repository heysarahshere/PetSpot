
<div class="col-md-10 ml-1">
    <h1>Sign In</h1>
    <form method="POST" action="{{route('sign-in-post')}}">
        <input class="form-control form-control-lg m-2"
               id="email"
               type="text"
               name="email"
               placeholder="Email"  required>
        <input class="form-control form-control-lg m-2"
               id="password"
               type="password"
               name="password"
               placeholder="password" minlength="6" required>
        <div class="form-group pt-3">
            <button type="submit" class="btn ombre">Sign in</button>
            <button type="button" class="btn rev-ombre"><a href="#">Forgot Password?</a></button>
        </div>
        {{ csrf_field() }}
    </form>
    <a data-toggle="modal" data-target="#signUpModal" data-dismiss="modal">New? Create an account.</a>
</div>
