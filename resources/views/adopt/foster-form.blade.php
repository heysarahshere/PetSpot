@extends('layout.master')
@section('title')
    Foster Form
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

        <div class="container-fluid m-5">
            <h1 class="text-center">Application to Foster</h1>
            <div class="row">
                <!-- member info-->
                <div class=" ml-3 col-sm-12 col-md-12 col-lg-12">
                    <form method="POST" action="{{route('foster-form-post')}}">
                        <div class="form-group col-lg-6 col-md-6 m-auto text-center">
                            <label for="pet" class="col-form-label">(OPTIONAL) Please select the name of the pet you're interested in.</label>
                            <select name="pet" id="pet" class="form-control">
                                <option selected>Any Pet</option>
                                @foreach($pets as $pet)
                                        <option>{{ $pet->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-6 m-auto">
                                <label for="firstName" class="col-form-label">First Name</label>
                                <input class="form-control form-control-sm" name="first_name" id="first_name" placeholder="First Name">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 m-auto">
                                <label for="firstName" class="col-form-label">Last Name</label>
                                <input class="form-control form-control-sm" name="last_name" id="last_name" placeholder="Last Name">
                            </div>
                            <div class="form-group col-lg-12 col-md-12 m-auto">
                                <label for="email" class="col-form-label">Email</label>
                                <input class="form-control form-control-sm" name="email" id="email" placeholder="Email">
                            </div>
                            <div class="form-group col-lg-12 col-md-12 m-auto">
                                <label for="phone" class="col-form-label">Phone</label>
                                <input class="form-control form-control-sm" name="phone" id="phone" placeholder="(123) 456-7890">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-7 col-md-7 m-auto">
                                <label for="city" class="col-form-label">City</label>
                                <input class="form-control form-control-sm" name="city" id="city" placeholder="City">
                            </div>
                            <div class="form-group col-lg-2 col-md-2 m-auto">
                                <label for="state" class="col-form-label">State</label>
                                <input class="form-control form-control-sm" name="state" id="state" placeholder="State">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 m-auto">
                                <label for="zip" class="col-form-label">Zipcode</label>
                                <input class="form-control form-control-sm" name="zip" id="zip" placeholder="Zipcode">
                            </div>
                            <div class="form-group col-lg-12 col-md-12 m-auto">
                                <label for="address_line_1" class="col-form-label">Street Line 1</label>
                                <input class="form-control form-control-sm" name="address_line_1" id="address_line_1"
                                       placeholder="123 N Main St">
                            </div>
                            <div class="form-group col-lg-12 col-md-12 m-auto">
                                <label for="address_line_2" class="col-form-label">Street Line 2</label>
                                <input class="form-control form-control-sm" name="address_line_2" id="address_line_2" placeholder="Apt 1">
                            </div>
                        </div>
                        {{--                        </form>--}}

                        <div class="col-sm-12 col-md-12 col-lg-12 p-0">
                            <div class="form-group mt-2">
                                <label for="urgency">I'm looking to foster...</label>
                                <select name="urgency" id="urgency" class="form-control">
                                    <option selected></option>
                                    <option>Immediately</option>
                                    <option>In a few Weeks</option>
                                    <option>In a few Months</option>
                                    <option>Unsure</option>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="answer_1">What kind of environment will you provide?</label>
                                <textarea class="form-control" name="answer_1" id="answer_1" rows="2"></textarea>
                            </div>
                            <div class="form-group mt-2">
                                <label for="answer_2">Do you have experience as foster care provider?</label>
                                <textarea class="form-control" name="answer_2" id="answer_2" rows="4"></textarea>
                            </div>
                            <div class="form-group mt-2">
                                <label for="answer_3">Do you have other animals currently under your care? If yes, how many/what breeds?</label>
                                <textarea class="form-control" name="answer_3" id="answer_3" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="duration">I want to foster for...</label>
                                <select name="duration" id="duration" class="form-control">
                                    <option selected></option>
                                    <option>Up to 2 Months</option>
                                    <option>2 to 6 Months</option>
                                    <option>6 Months to 1 Year</option>
                                    <option>Unsure</option>
                                </select>
                                <div class="form-group pt-3">
                                    <button type="submit" class="btn btn-light ombre">Submit</button>
                                    <button type="reset"  class="btn rev-ombre"><a href="{{route('adopt-form')}}">Reset</a></button>
                                </div>
                                {{ csrf_field() }}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection
