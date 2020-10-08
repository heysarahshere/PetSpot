<?php

namespace App\Http\Controllers;

use App\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function getOptions()
    {
        return view('donation/options');
    }

    public function getContinue(Request $request)
    {
        $donation_plan = $request->input('donationOption');
        $honor = $request->input('honor');
        $plan = $request->input('plan');

        if($donation_plan === "1"){
            $plan = "One-Time";
            $amount = $request->input('customAmount');
        } else if ($donation_plan === "2"){
            $plan = "Monthly";
            $amount = $request->input('customAmount2');
        } else if ($donation_plan === "3"){
            $plan = "Yearly";
            $amount = $request->input('customAmount3');
        } else {
            $plan = "";
            $amount = 0;
        }
        return view('donation/continue', [
            'plan' => $plan,
            'amount' => $amount,
            'honor' => $honor
        ]);
    }

    public function postDonation(Request $request){
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'line_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required|integer|min:5',
            'phone' => 'required',
            'email' => 'required',
            'creditCardNumber' => 'required|integer',
            'creditCardMonth' => 'required|integer',
            'creditCardYear' => 'required|integer',
            'creditCardType' => 'required',
            'creditCardCode' => 'required|integer'
        ]);
        $last_four = substr($request->input('creditCardNumber'), -4);
        $donation = new Donation([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'line_1' => $request->input('line_1'),
            'line_2' => $request->input('line_2'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zip' => $request->input('zip'),
            'creditCardNumber' => $last_four,
            'creditCardMonth' => $request->input('creditCardMonth'),
            'creditCardYear' => $request->input('creditCardYear'),
            'creditCardType' => $request->input('creditCardType'),
            'creditCardCode' => $request->input('creditCardCode'),
            'note' => $request->input('note'),
            'plan' => $request->input('plan'),
            'amount' => $request->input('amount'),
        ]);

        if($request->input('honor') !=''){
            $donation->honor = $request->input('honor');
        }

        if(Auth::check()){
            $donation->user_id = auth()->user()->id;
        }

        $donation->save();

        // save here
        return redirect('donation/success');
    }

    public function getSuccess(){
        return view('donation/success');
    }


    public function getDonations()
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $onetime_donations = Donation::where('user_id', $user_id)->where('plan', 'One-Time')->where('status', 'Active')->get();
            $comp_onetime_donations = Donation::where('user_id', $user_id)->where('plan', 'One-Time')->where('status', 'Completed')->get();
            $monthly_donations = Donation::where('user_id', $user_id)->where('plan', 'Monthly')->where('status', 'Active')->get();
            $yearly_donations = Donation::where('user_id', $user_id)->where('plan', 'Yearly')->where('status', 'Active')->get();
            $cancelled_donations = Donation::where('user_id', $user_id)->where('status', 'Inactive')->get();

            return view('user/donations')->with([
                'onetime_donations' => $onetime_donations,
                'monthly_donations' => $monthly_donations,
                'yearly_donations' => $yearly_donations,
                'cancelled_donations' => $cancelled_donations,
                'comp_onetime_donations' => $comp_onetime_donations
            ]);

        }
        return redirect()->back()->with('message', 'You must be logged in to do that.');
    }

    public function cancelDonationSubscription(Request $request){
        if(Auth::check()){
            $donation_id = $request->input('donation_id');
            $donation_subscription = Donation::find($donation_id);
            $ended = date('Y-m-d H:i:s');
//            $ended = date('d M Y - H:i:s');
            $donation_subscription->update(['status' => 'Inactive', 'end_date' => $ended]);
            $donation_subscription->save();

            $user_id = Auth::user()->id;
            return redirect()->back()->with('message', 'Your donation subscription was cancelled.');

        }
        return redirect()->back()->with('message', 'You must be logged in to do that.');

    }
}
