@extends('layout.master')
@section('title')

    @if(Auth::check())
        <?PHP $user = Auth::user(); ?>
        Donations - {{$user->firstName}} {{$user->lastName}}
    @else
        Oops
    @endif
@endsection
@section('content')

    <header>
        @include('partials.nav')
        @include('partials.errors')
        @include('partials.message')
    </header>
    @if(Auth::check())
        <?PHP $user = Auth::user(); ?>
        <div class="wrapper">
            <!-- Sidebar -->
        @include('partials.side-nav')

        <!-- Page Content -->

            <div class="container-fluid mb-3 mt-0 m-0 m-md-2 m-lg-4 profile">
                <div class=" row my-3 text-left" style="margin: 0 auto">
                    <div class="col-xs-7 col-sm-2 col-xl-1">
                        <div class="round-img"
                             style="background-image: url('{{ Storage::disk('s3')->url($user->profile_image)}}')">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-10 col-md-9">
                        <h2 class="ml-3 mt-3 viewing">Donations Made</h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">

                        <div class="accordion donationAccordion"  id="profileAccordion">

{{-- PENDING ONE-TIME --}}
                            <div class="card ">
                                <div class="card-header" id="heading3">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                            Pending One-Time Donations
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#profileAccordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                @forelse($onetime_donations as $donation)
                                                    <div class="card col-12 m-2 ">
                                                        <div class="card-body row">
                                                            <div class="col-sm-10 col-md-7">
                                                                <h2 class="m-0" style="font-weight: bold">${{$donation->amount}}.00
                                                                </h2>      <p>Created {{$donation->created_at->diffForHumans()}}
                                                                    @unless(empty($donation->honor))
                                                                        In Honor Of {{ $donation->honor }}
                                                                    @endunless</p>
                                                                <h3>Payment Method: Card ending in {{$donation->creditCardNumber}}</h3> </div>
                                                            <div class="col-sm-2 col-md-3">
                                                                <form name="delete-read" action="{{route('cancel-donation')}}" method="post"
                                                                      class=" ml-auto text-right">
                                                                    <input type="hidden" name="donation_id" id="donation_id" value="{{$donation->id}}">
                                                                    <button class="btn btn-sm rev-ombre">Cancel</button>
                                                                    {{ csrf_field() }}
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($loop->last)


                                                    @endif
                                                @empty
                                                    There are no donations to display. <a style="font-weight: bold" href="{{route('donate')}}">Make one now.</a>
                                                @endforelse

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
{{-- MONTHLY --}}
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Monthly Subscriptions
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#profileAccordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                @forelse($monthly_donations as $donation)
                                                    <div class="card col-12 m-2">
                                                        <div class="card-body row">
                                                            <div class="col-sm-10 col-md-7">
                                                                <h2 class="m-0" style="font-weight: bold">${{$donation->amount}}.00
                                                                    @if($donation->honor != '')
                                                                        In Honor Of {{ $donation->honor }}
                                                                    @endif
                                                                </h2>
                                                                <h3>Payment Method: Card ending in {{$donation->creditCardNumber}}</h3>
                                                                <p>Created {{$donation->created_at->diffForHumans()}}
                                                                    @unless(empty($donation->honor))
                                                                        In Honor Of {{ $donation->honor }}
                                                                    @endunless</p>
                                                            </div>
                                                            <div class="col-sm-2 col-md-3">
                                                                <form name="delete-read" action="{{route('cancel-donation')}}" method="post"
                                                                      class=" ml-auto text-right">
                                                                    <input type="hidden" name="donation_id" id="donation_id" value="{{$donation->id}}">
                                                                    <button class="btn btn-sm rev-ombre">Cancel</button>
                                                                    {{ csrf_field() }}
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($loop->last)


                                                    @endif
                                                @empty
                                                    There are no active donation subscriptions. <a style="font-weight: bold" href="{{route('donate')}}">Make one now.</a>
                                                @endforelse

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
{{-- YEARLY --}}
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Yearly Donations
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#profileAccordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                @forelse($yearly_donations as $donations)
                                                    <div class="card col-12 m-2">
                                                        <div class="card-body row">
                                                            <div class="col-sm-10 col-md-7">
                                                                <h2 class="m-0" style="font-weight: bold">${{$donation->amount}}.00
                                                                    @if($donation->honor != '')
                                                                        In Honor Of {{ $donation->honor }}
                                                                    @endif
                                                                </h2>
                                                                <h3>Payment Method: Card ending in {{$donation->creditCardNumber}}</h3>
                                                                <p>Created {{$donation->created_at->diffForHumans()}}
                                                                    @unless(empty($donation->honor))
                                                                        In Honor Of {{ $donation->honor }}
                                                                    @endunless</p>
                                                            </div>
                                                            <div class="col-sm-2 col-md-3">
                                                                <form name="delete-read" action="{{route('cancel-donation')}}" method="post"
                                                                      class=" ml-auto text-right">
                                                                    <input type="hidden" name="donation_id" id="donation_id" value="{{$donation->id}}">
                                                                    <button class="btn btn-sm rev-ombre">Cancel</button>
                                                                    {{ csrf_field() }}
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    There are no active donation subscriptions. <a style="font-weight: bold" href="{{route('donate')}}">Make one now.</a>
                                                @endforelse
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
{{-- ONE-TIME --}}
                            <div class="card">
                                <div class="card-header" id="heading5">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                                            Completed One-Time Donations
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#profileAccordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                @forelse($comp_onetime_donations as $donation)
                                                    <div class="card col-12 m-2">
                                                        <div class="card-body row">
                                                            <div class="col-sm-10 col-md-7">
                                                                <h2 class="m-0" style="font-weight: bold">${{$donation->amount}}.00
                                                                    @if($donation->honor != '')
                                                                        In Honor Of {{ $donation->honor }}
                                                                    @endif
                                                                </h2>
                                                                <h3>Payment Method: Card ending in {{$donation->creditCardNumber}}</h3>
                                                                <p>Created {{$donation->created_at->diffForHumans()}}
                                                                    @unless(empty($donation->honor))
                                                                        In Honor Of {{ $donation->honor }}
                                                                    @endunless</p>
                                                            </div>
                                                            <div class="col-sm-2 col-md-3">
                                                                <form name="delete-read" action="{{route('cancel-donation')}}" method="post"
                                                                      class=" ml-auto text-right">
                                                                    <button class="btn btn-sm rev-ombre">Cancel</button>
                                                                    {{ csrf_field() }}
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($loop->last)


                                                    @endif
                                                @empty
                                                    There are no donations to display. <a style="font-weight: bold" href="{{route('donate')}}">Make one now.</a>
                                                @endforelse

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
{{-- CANCELLED --}}
                            <div class="card">
                                <div class="card-header" id="heading4">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                            Cancelled Donations
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#profileAccordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                @forelse($cancelled_donations as $donation)
                                                    <div class="card col-12 m-2">
                                                        <div class="card-body row">
                                                            <div class="col-sm-10 col-md-7">
                                                                <h2 class="m-0" style="font-weight: bold">${{$donation->amount}}.00 {{$donation->plan}}
                                                                    @if($donation->honor)
                                                                        In Honor Of {{ $donation->honor }}
                                                                    @endif
                                                                </h2>
                                                                <h3>Payment Method: Card ending in {{$donation->creditCardNumber}}</h3>
                                                                <p>Created {{$donation->created_at->format('d M Y - g:i a')}}, Ended on {{date('d M Y - g:i a', strtotime($donation->end_date))}} </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    There are no cancelled donation subscriptions.
                                                @endforelse
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- not logged in --}}
    @else
        <div class="wrapper">
            <!-- Sidebar -->

        @include('partials.side-nav')
        <!-- Page Content -->
            <div class="p-4">
                <h1>Oops, you need an account to do that.</h1>
                <hr>
                <button class="btn ombre"><a href="{{route('login')}}">Sign-In</a></button>
                <button class="btn light-ombre"><a href="{{route('sign-up')}}">Sign-Up</a></button>
            </div>
        </div>  <!-- end wrapper -->

    @endif
@endsection
<script>
    window.onload = function ready() {
        $('#profileMenu').collapse('show');
    }
</script>
