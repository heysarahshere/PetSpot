@extends('layout.master')
@section('title')
    Pet Fostering Information
@endsection
@section('content')

    <header>
        @include('partials.nav')
        @include('partials.message')
        @include('partials.errors')
    </header>
    <div class="wrapper">

        <!-- Sidebar -->
    @include('partials.side-nav')

    <!-- Page Content -->
        <div class="container-fluid m-0 m-md-5 adopt-info-text">
            <div class="row">
                <button class="btn btn-lg btn-outline-light ombre m-2"><a href="{{route('foster-form')}}">Apply to Foster</a></button>
                <button class="btn btn-lg btn-outline-light ombre m-2"><a href="{{route('available')}}">View Available Pets</a></button>
            </div>
            <hr>
            <h1>Things to Consider Before Fostering a Pet</h1>
            <br>
            <h2>Are you able to separate the foster pets from your own?</h2>
            <p>You should have a place where you can isolate your foster pet from your
                own companion animals. A separate room or enclosed area with no carpet will work best.</p>
            <br>

            <h2>Are you prepared to pet-proof your home?</h2>
            <p>Preparing your home and the area the animal will stay in can prevent most accidents,
                help keep you pet safe and help set you both up for fostering success.</p>
            <br>

            <h2>Are you willing to help a pet with medical concerns or who may need medication?</h2>
            <p>Ask if your foster pet has any medical considerations to be aware or any medication he needs to take. If so,
                make sure that you’re willing and able to make sure your foster pet is getting the medication or care that he or she may need.</p>
            <br>

            <h2>Qualifications</h2>
            <p>To be a successful foster parent, you will need a compassionate nature, the cooperation of your family or roommates, flexibility, and some knowledge of animal behavior.
                The length of time a foster pet may stay in your home varies with the animal’s situation.
                <br>
                You will most likely be asked to fill out a foster application and you may be asked to attend a training session. Shelter or rescue group staffers may conduct a
                home visit prior to your receiving your first foster pet.</p>
            <br>

            <h2>Foster Policies and Procedures</h2>
            <p>Every adoption organization has its own policies and procedures when it comes to fostering.<br>
                Most likely, a foster-care coordinator will work with you to identify the type of pet you should foster (puppies, large or small dogs, cats, etc.).<br>
                Many organizations require that a foster parent’s own pets are up-to-date on all vaccinations before the volunteer can foster.<br>
                Some organizations will provide the foster parent with food and supplies for the pet’s care.</p>
            <br>

            <h2>Preparing Your Home</h2>
            <p>If you are fostering kittens or puppies, remember that they will play or chew anything they can find,
                including drapes, electrical cords and lampshades. So be sure to kitten-/puppy-proof your home.</p>
            <br>

            <h2>Supplies You May Need:</h2>
            <p>A “house” for the pet: You can use the carrier in which you took the animal home, a crate or a cardboard box — anything that will provide the pet a familiar-smelling, dark, quiet refuge.
                <br>
                Water: Provide access to clean, fresh water at all times. Remember, very young animals can drown, so make sure the bowl is very shallow.
                <br>
                Food: Speak with the shelter or rescue group about what kind of food, the amounts and how often to feed your foster pet. The shelter or rescue group will also tell you if the
                pet you are fostering needs any special foods, supplements or diets.
                <br>
                Litter box and cat litter for foster cats: Cats will instinctively use a litter box and mom will begin teaching her kittens how to use it. Speak with your shelter or rescue
                 group about whether it prefers you use clumping or non-clumping litter, as some require non-clumping litter for kittens younger than four months old.
                <br>
                Heating pad or hot water bottle: Depending on how warm your room is, these extras will ensure that everyone is comfy and cozy. If you use any of these items, be sure
                that there is space for the pet to move away from the heat in case she is too hot, and always place heating pads on the lowest setting.
                <br>
                Toys: Go crazy if you want! Mice and buzz balls make kittens happy and can be reused as long as animals do not have any contagious diseases. Kittens can amuse themselves
                with empty rolls of toilet paper.
                <br>
                Scale: Although not critical to success, a food or postal scale is very helpful for monitoring small kittens’ growth, which averages four ounces a week.
                <br>
                Other considerations: A bottle of enzymatic cleaner for accidents; a rope or carpet scratching post; and adoption applications to give to people who are interested
                in your foster care animals.</p>
            <br>

            <h2>When to Return a Foster Pet to the Shelter</h2>
            <p>If you’re fostering through a shelter with a physical location, sometimes it is difficult for shelter staff to predict the exact date when the pet will be ready for adoption.
                Several factors contribute to this decision:<p>
                <br>
                    <ul style="list-style-type: circle; margin-left: 5%">
                        <li><p>Did the puppies/kittens gain enough weight?</p></li>
                        <li><p>Are the animals healthy and recovered fully from illness?</p></li>
                        <li><p>Are they successfully weaned from their mother?</p></li>
                        <li><p>Have they been successfully socialized?</p></li>
                        <li><p>Is there room at the shelter?</p></li>
                    </ul>

            <br>
            <p>Because of these variables, the foster pet may not be ready for adoption by the date on your foster home contract.
                Please call the foster home coordinator to make an appointment to return your pet. Your flexibility and patience is always appreciated!</p>
            <hr>
        </div>

    </div>

@endsection
