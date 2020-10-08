@extends('layout.master')
@section('title')
    Donate - Step 1
@endsection
@section('content')

    <header>
        @include('partials.nav')
        @include('partials.message')
        @include('partials.errors')
    </header>

    <div class="container-fluid donate-banner">
        <h1 style="color: white; text-align: center; padding-top: 8%">We Need Your Support</h1>
    </div>
    <div class="container-fluid donate-container" style="text-align: center; margin: 0 auto">
        <hr>
        <h2>Please choose a donation option.</h2>
        {{--  cards  --}}
        <div class="row pt-2 order-md-2" style="justify-content: center">
            {{-- card 1 --}}
            <div class="col-sm-10 col-md-8 col-lg-4 col-xl-3 pt-4">
                <div class="card card-hover pet-card" style="position: relative;">
                    <form id="plan1" action="{{route('donate-continue')}}" method="GET">
                        <div class="card-body text-center">
                            <h1>One-Time</h1>
                            <h3>Choose Amount</h3>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-md btn-outline-light ombre-sq">
                                    <input type="radio" name="option1" id="option1" onclick="changeDiv('1');"> $5
                                </label>
                                <label class="btn btn-md btn-outline-light ombre-sq">
                                    <input type="radio" name="option2" id="option2" onclick="changeDiv('2');"> $25
                                </label>
                                <label class="btn btn-md btn-outline-light ombre-sq">
                                    <input type="radio" name="option3" id="option3" onclick="changeDiv('3');"> $50
                                </label>
                                <label class="btn btn-md btn-outline-light ombre-sq">
                                    <input type="radio" name="customCheck" id="customCheck" onclick="changeDiv('0');">
                                    Custom
                                </label>
                            </div>
                            <p id="customP"
                               style="padding: 2%; color: #7d7d7d; visibility: hidden; position: absolute"></p>
                            <div id="cus" style="visibility:hidden">
                                <div class="mt-2 input-group" style="justify-content: center">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">$</span>
                                    </div>

                                    <input style="max-width: 25%; text-align: center;" value="0" pattern="[0-9]"
                                           title="Numbers only" min="1" id='customAmount' name='customAmount'
                                           type="number" class="form-control" aria-describedby="basic-addon1" min="0" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1">.00</span>
                                    </div>
                                </div>
                            </div>
                            <p style="color: #3e3e3e; font-weight: bold">In honor of:</p>
                            <div class="row" style="justify-content: center;">
                                <input style="text-align: center" type="text" id='honor' name='honor'>
                            </div>
                            <input type="hidden" name="donationOption" value="1">
                            <button class="btn btn-large btn-outline-light ombre mt-4" type="submit">
                                Select
                            </button>

                            <div class="reveal ombre p-2 float-right status-btn"
                                 style="position: absolute; top: 10px; right: 2%">
                                <p style="color: white; font-weight: lighter"><i class="fa fa-paw"></i></p>
                            </div>

                        </div>
                    </form>
                    <div class="card-footer">
                        <x-small class="text-muted">One-Time Donation</x-small>
                    </div>
                </div>
                </a>
            </div> <!-- col // -->
            {{-- card 2 --}}
            <div class="col-sm-10 col-md-8 col-lg-4 col-xl-3 pt-4">
                <div class="card card-hover pet-card" style="position: relative;">
                    <form id="plan2" action="{{route('donate-continue')}}" method="GET">
                        <div class="card-body text-center">
                            <h1>Monthly</h1>
                            <h3>Choose Amount</h3>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-md btn-outline-light ombre-sq">
                                    <input type="radio" name="option1" id="option1" onclick="changeDiv2('1');"> $10
                                </label>
                                <label class="btn btn-md btn-outline-light ombre-sq">
                                    <input type="radio" name="option2" id="option2" onclick="changeDiv2('2');"> $20
                                </label>
                                <label class="btn btn-md btn-outline-light ombre-sq">
                                    <input type="radio" name="option3" id="option3" onclick="changeDiv2('3');"> $40
                                </label>
                                <label class="btn btn-md btn-outline-light ombre-sq">
                                    <input type="radio" name="customCheck" id="customCheck" onclick="changeDiv2('0');">
                                    Custom
                                </label>
                            </div>
                            <p id="customP2"
                               style="padding: 2%; color: #7d7d7d; visibility: hidden; position: absolute"></p>
                            <div id="cus2" style="visibility:hidden">
                                <div class="mt-2 input-group" style="justify-content: center">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">$</span>
                                    </div>
                                    <input style="max-width: 25%; text-align: center;" pattern="[0-9]"
                                           title="Numbers only" min="1" id='customAmount2' name='customAmount2'
                                           type="number" class="form-control" aria-describedby="basic-addon1" min="0" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1">.00</span>
                                    </div>
                                </div>
                            </div>
                            <p style="color: #3e3e3e; font-weight: bold">In honor of:</p>
                            <div class="row" style="justify-content: center;">
                                <input style="text-align: center" type="text" id='honor' name='honor'>
                            </div>
                            <input type="hidden" name="donationOption" value="2">
                            <button class="btn btn-large btn-outline-light ombre mt-4"  type="submit">
                                Select
                            </button>

                            <div class="reveal ombre p-2 float-right status-btn"
                                 style="position: absolute; top: 10px; right: 2%">
                                <p style="color: white; font-weight: lighter"><i class="fa fa-paw"></i></p>
                            </div>

                        </div>
                    </form>
                    <div class="card-footer">
                        <x-small class="text-muted">Monthly Donation Subscription</x-small>
                    </div>
                </div>
            </div> <!-- col // -->
            {{-- card 3 --}}
            <div class="col-sm-10 col-md-8 col-lg-4 col-xl-3 pt-4">
                <div class="card card-hover pet-card" style="position: relative;">
                    <form id="plan3" action="{{route('donate-continue')}}" method="GET">
                        <div class="card-body text-center">
                            <h1>Yearly</h1>
                            <h3>Choose Amount</h3>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-md btn-outline-light ombre-sq">
                                    <input type="radio" name="option1" id="option1" onclick="changeDiv3('1');"> $25
                                </label>
                                <label class="btn btn-md btn-outline-light ombre-sq">
                                    <input type="radio" name="option2" id="option2" onclick="changeDiv3('2');"> $50
                                </label>
                                <label class="btn btn-md btn-outline-light ombre-sq">
                                    <input type="radio" name="option3" id="option3" onclick="changeDiv3('3');"> $100
                                </label>
                                <label class="btn btn-md btn-outline-light ombre-sq">
                                    <input type="radio" name="customCheck" id="customCheck" onclick="changeDiv3('0');">
                                    Custom
                                </label>
                            </div>
                            <p id="customP3"
                               style="padding: 2%; color: #7d7d7d; visibility: hidden; position: absolute"></p>
                            <div id="cus3" style="visibility:hidden">
                                <div class="mt-2 input-group" style="justify-content: center">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">$</span>
                                    </div>

                                    <input style="max-width: 25%; text-align: center;" pattern="[0-9]"
                                           title="Numbers only" min="1" id='customAmount3' name='customAmount3'
                                           type="number" class="form-control" aria-describedby="basic-addon1" min="0" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1">.00</span>
                                    </div>
                                </div>
                            </div>
                            <p style="color: #3e3e3e; font-weight: bold">In honor of:</p>
                            <div class="row" style="justify-content: center; text-align: center">
                                <input style="text-align: center" type="text" id='honor' name='honor'>
                            </div>
                            <input type="hidden" name="donationOption" value="3">
                            <button class="btn btn-large btn-outline-light ombre mt-4" type="submit">
                                Select
                            </button>

                            <div class="reveal ombre p-2 float-right status-btn"
                                 style="position: absolute; top: 10px; right: 2%">
                                <p style="color: white;"><i class="fa fa-paw"></i></p>
                            </div>

                        </div>
                    </form>
                    <div class="card-footer">
                        <x-small class="text-muted">Annual Donation Subscription</x-small>
                    </div>
                </div>
                </a>
            </div> <!-- col // -->
        </div> {{-- end row --}}
        {{--  text  --}}
        <div class="row pt-5 order-md-1" style="justify-content: center;">
            <div class="col-sm-12 col-md-8 col-lg-4 col-xl-3 ">
                <h2>Every gift saves lives</h2>
                <p>We rely on cash donations to continue helping the animals in our region.
                    Please make a one time gift if you are not able to make a monthly or yearly commitment.</p>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-4 col-xl-3 ">
                <h2>Your donations are tax deductible</h2>
                <p>At the end of the year, you will receive an annual statement of your donations,
                    with the required IRS language. <br></p>
                <p class="lead">Tax ID 91-1829881</p>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-4 col-xl-3 ">
                <h2>Choose how we spend your gift</h2>
                <p>Have a specific animal in mind? Simply mention their name.
                    Want to buy our most needed supplies directly? See our wishlist <a style="color: #d13b16"
                                                                                       href="https://www.amazon.com/hz/wishlist/ls/146B5UNW6DPOM/ref=cm_go_nav_hz"
                                                                                       target="_blank">here</a>.</p>
            </div>
        </div> {{-- end row --}}
        <hr>
    </div>
    <input type="hidden" name="plan" id="plan" value="">
    <div class="container-fluid donate-banner2">
    </div>
@endsection

<script type="text/javascript">
    function submitForm(plan) {
        document.getElementById(plan).submit();
    }

    function changeDiv(number) {
        if (number === "1") {
            document.getElementById("customP").innerHTML = "A new collar or leash!";
            document.getElementById('customP').style.position = 'relative';
            document.getElementById('customP').style.visibility = 'visible';
            document.getElementById('cus').style.visibility = 'hidden';
            document.getElementById('cus').style.position = 'absolute';
            document.getElementById("customAmount").value = "5";
        } else if (number === "2") {
            document.getElementById("customP").innerHTML = "Food for one month.";
            document.getElementById('customP').style.position = 'relative';
            document.getElementById('customP').style.visibility = 'visible';
            document.getElementById('cus').style.visibility = 'hidden';
            document.getElementById('cus').style.position = 'absolute';
            document.getElementById("customAmount").value = "25";
        } else if (number === "3") {
            document.getElementById("customP").innerHTML = "A vet visit.";
            document.getElementById('customP').style.position = 'relative';
            document.getElementById('customP').style.visibility = 'visible';
            document.getElementById('cus').style.visibility = 'hidden';
            document.getElementById('cus').style.position = 'absolute';
            document.getElementById("customAmount").value = "50";
        } else if (number === "0") {
            document.getElementById("customP").innerHTML = "";
            document.getElementById('customP').style.position = 'absolute';
            document.getElementById('cus').style.position = 'relative';
            document.getElementById('cus').style.visibility = 'visible';
        }
    }
    function changeDiv2(number) {
        if (number === "1") {
            document.getElementById("customP2").innerHTML = "Bath supplies!";
            document.getElementById('customP2').style.position = 'relative';
            document.getElementById('customP2').style.visibility = 'visible';
            document.getElementById('cus2').style.visibility = 'hidden';
            document.getElementById('cus2').style.position = 'absolute';
            document.getElementById("customAmount2").value = "10";
        } else if (number === "2") {
            document.getElementById("customP2").innerHTML = "Food for a month.";
            document.getElementById('customP2').style.position = 'relative';
            document.getElementById('customP2').style.visibility = 'visible';
            document.getElementById('cus2').style.visibility = 'hidden';
            document.getElementById('cus2').style.position = 'absolute';
            document.getElementById("customAmount2").value = "20";
        } else if (number === "3") {
            document.getElementById("customP2").innerHTML = "Monthly treatments & care!";
            document.getElementById('customP2').style.position = 'relative';
            document.getElementById('customP2').style.visibility = 'visible';
            document.getElementById('cus2').style.visibility = 'hidden';
            document.getElementById('cus2').style.position = 'absolute';
            document.getElementById("customAmount2").value = "40";
        } else if (number === "0") {
            document.getElementById("customP2").innerHTML = "";
            document.getElementById('customP2').style.position = 'absolute';
            document.getElementById('cus2').style.position = 'relative';
            document.getElementById('cus2').style.visibility = 'visible';
        }
    }
    function changeDiv3(number) {
        if (number === "1") {
            document.getElementById("customP3").innerHTML = "Replenishes needed supplies.";
            document.getElementById('customP3').style.position = 'relative';
            document.getElementById('customP3').style.visibility = 'visible';
            document.getElementById('cus3').style.visibility = 'hidden';
            document.getElementById('cus3').style.position = 'absolute';
            document.getElementById("customAmount3").value = "25";
        } else if (number === "2") {
            document.getElementById("customP3").innerHTML = "Vet visits & check-ups!";
            document.getElementById('customP3').style.position = 'relative';
            document.getElementById('customP3').style.visibility = 'visible';
            document.getElementById('cus3').style.visibility = 'hidden';
            document.getElementById('cus3').style.position = 'absolute';
            document.getElementById("customAmount3").value = "50";
        } else if (number === "3") {
            document.getElementById("customP3").innerHTML = "Larger medical expenses.";
            document.getElementById('customP3').style.position = 'relative';
            document.getElementById('customP3').style.visibility = 'visible';
            document.getElementById('cus3').style.visibility = 'hidden';
            document.getElementById('cus3').style.position = 'absolute';
            document.getElementById("customAmount3").value = "100";
        } else if (number === "0") {
            document.getElementById("customP3").innerHTML = "";
            document.getElementById('customP3').style.position = 'absolute';
            document.getElementById('cus3').style.position = 'relative';
            document.getElementById('cus3').style.visibility = 'visible';
        }
    }
</script>
