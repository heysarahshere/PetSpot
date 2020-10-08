@extends('layout.master')
@section('title')
    Donate - Step 2
@endsection
@section('content')

    <header>
        @include('partials.nav')
        @include('partials.errors')
        @include('partials.message')
    </header>
    <div class="wrapper">
    <!-- Page Content -->
        <div class="container-fluid">
            <div class="row mt-4" style="justify-content: center">
                <div class="col-sm-12 col-md-10 col-lg-10">
                    <h1 class="text-center" style="font-weight: bold">${{ $amount }}.00 {{ $plan }} Donation</h1> @if ($honor)<h1 class="text-center" style="color: #d13b16; font-weight: lighter">In Honor of {{ $honor }} </h1>@endif
                    <hr>
                    <form action="{{route('donate-complete')}}" method="post">
                        <div class="row">
                            <div class="col-lg-12">
                                <img class="float-right" style="max-height: 5%;" src="{{asset('../images/accepted_cards.png')}}">
                                <h2>Payment Information</h2>
                                <input type="hidden" name="plan" id="plan" value="{{$plan}}">
                                <input type="hidden" name="amount" id="amount" value="{{$amount}}">
                                <input type="hidden" name="honor" id="honor" value="{{$honor}}">
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="creditCardNumber">Credit Card Number</label>
                                        <input type="number" class="form-control" id="creditCardNumber" name="creditCardNumber"
                                               placeholder="1234123412341234" maxlength="16" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="creditCardType">Card Type</label>
                                        <select id="creditCardType" name="creditCardType" class="form-control">
                                            <option selected>Choose...</option>
                                            <option>Mastercard</option>
                                            <option>Discover</option>
                                            <option>American Express</option>
                                            <option>Visa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="creditCardMonth">Exp Month</label>
                                        <input type="number" class="form-control" id="creditCardMonth" name="creditCardMonth"
                                               placeholder="MM*" maxlength="2" required>
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label for="creditCardYear">Exp Year</label>
                                        <input type="number" class="form-control" id="creditCardYear" name="creditCardYear"
                                               placeholder="YYYY*" maxlength="4" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="creditCard">CVV</label>
                                        <input type="number" class="form-control" id="creditCardCode" name="creditCardCode"
                                               placeholder="CVV*" maxlength="3" required>
                                        <p style="font-size: small">What is CVV?</p>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <hr>
                                    <h2>Personal Information</h2>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                               value="{{ old('first_name') }}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                               value="{{ old('last_name') }}" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                               value="{{ old('email') }}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                               value="{{ old('phone') }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="line_1">Address</label>
                                    <input type="text" class="form-control" id="line_1" name="line_1"
                                           value="{{ old('line_1') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="line_2">Address 2</label>
                                    <input type="text" class="form-control" id="line_2" name="line_2"
                                           value="{{ old('line_2') }}">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city"
                                               name="city" value="{{ old('city') }}" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="state">State</label>
                                        <select id="state" name="state" class="form-control">
                                            <option value="{{ old('state') }}" selected required></option>
                                            <option value="AK">Alaska</option>
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DC">District of Columbia</option>
                                            <option value="DE">Delaware</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="IA">Iowa</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MD">Maryland</option>
                                            <option value="ME">Maine</option>
                                            <option value="MI">Michigan</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MO">Missouri</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MT">Montana</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="NV">Nevada</option>
                                            <option value="NY">New York</option>
                                            <option value="OH">Ohio</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="OR">Oregon</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="PR">Puerto Rico</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="TX">Texas</option>
                                            <option value="UT">Utah</option>
                                            <option value="VA">Virginia</option>
                                            <option value="VT">Vermont</option>
                                            <option value="WA">Washington</option>
                                            <option value="WI">Wisconsin</option>
                                            <option value="WV">West Virginia</option>
                                            <option value="WY">Wyoming</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="shipping_line2">Zip</label>
                                        <input type="text" class="form-control" id="zip" name="zip"
                                               value="{{ old('zip') }}" required>
                                    </div>
                                    <div class="form-group col-md-12">

                                        <label for="note">Notes</label>
                                        <textarea class="form-control" rows="5" cols="10" id="note" name="note"
                                                  placeholder="If you would like to support a specific surgery, animal, or need, please specify it here.">{{ old('note') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            @method('POST')
                            {{ csrf_field() }}
                            <div class="form-group p-5 m-auto">
                                <button type="submit" class="btn btn-lg btn-block ombre">Confirm Donation</button>
                            </div>
                        </div> {{-- end row --}}
                    </form>
                </div>
            </div>

        </div>

    </div>

@endsection
