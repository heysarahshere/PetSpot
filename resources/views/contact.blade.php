@extends('layout.master')
@section('title')
    Contact
@endsection
@section('content')

    <header>
        @include('partials.nav')
        @include('partials.message')
        @include('partials.errors')
    </header>
    <div class="wrapper">

        <!-- Sidebar -->
{{--    @include('partials.side-nav')--}}

    <!-- Page Content -->

        <div class="container-fluid  mt-3 m-md-4 m-lg-5">
            <h1 class="text-center">Get in Touch</h1>
            <div class="row text-center" style="justify-content: center">
                <div class="col-12 col-md-10 col-lg-8">
                    <p style="color: black; font-weight: normal">Typically, one of our team members will respond within 24 business hours of receiving your message. </p>
                    <p style="color: black; font-weight: normal">If you require a faster response, please call or email instead.</p>
                    <p style="color: #d13b16; font-weight: bold">If you have an urgent animal health concern, please call your local emergency vet immediately.</p>
                </div>
                <div class="col-12 col-md-10 col-lg-8 pt-3">
                    <a class="p-0"><p style="color: #1c1c1c; font-weight: normal">Phone: (555) 555-5555</p></a>
                    <a class="p-0 hide-md nav-link" href="mailto:info@petspot.org?subject=Important!&body=Hi."
                       target="_blank" rel="noopener noreferrer"><p style="color: #1c1c1c; font-weight: normal">Email: info@petspot.org</p></a>
                </div>
            </div>
            <hr>
            <div class="col-12 col-md-10 col-lg-8" style="margin: 0 auto; text-align: center">
                <h2>Message Subject</h2>
                <form name="report" method="POST" action="{{route('send-contact-message')}}">

                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <h3>Your Full Name</h3>
                            <input type="text" name="name" id="name" class="form-control"
                                   placeholder="Full Name" required value="{{ old('name') }}">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <h3>Your Email</h3>
                            <input type="email" name="email" id="email" class="form-control"
                                   placeholder="Email" required value="{{ old('email') }}">
                        </div>
                    </div>
                    <h3>Subject</h3>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="text" name="subject" id="subject" class="form-control"
                                   placeholder="Subject" required value="{{ old('subject') }}">
                        </div>
                    </div>
                    <h3>Topic</h3>
                    <div class="form-row">
                        <select class="form-control form-control-lg" id="reason"  name="reason">
                            <option selected value="{{ old('reason') }}" required></option>
                            <option>Adopting or Fostering a Pet</option>
                            <option>Specifying Donation Use</option>
                            <option>Pet Health Concern</option>
                            <option>Locating a Lost Pet</option>
                            <option>Turning in a Found Pet</option>
                            <option>Account Concern</option>
                            <option>Subscription or Privacy Concern</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <h3 class="pt-2">More Details:</h3>
                    <div class="form-row pt-2">
            <textarea rows="5" id="other" name="other"
                      class="form-control" required>{{ old('other') }}</textarea>
                    </div>

                    <input type="hidden" value="" name="post_id" id="post_id">
                    <div class="form-group pt-3">
                        <button type="submit" class="btn ombre">Send Message</button>
                    </div>
                    {{ csrf_field() }}
                </form>
            </div>



        </div><!-- /.container -->

    </div>

@endsection
