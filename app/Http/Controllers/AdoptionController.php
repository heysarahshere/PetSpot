<?php

namespace App\Http\Controllers;

use App\AdoptionForm;
use App\FosterForm;
use App\Pet;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdoptionController extends Controller
{

//    ------------------------------------- Adoption Form

    public function getForm()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (count($user->adoptForms) < 3) {
                $pets = Pet::where('status', '=', 'available')->get();
                return view('adopt/form', ['pets' => $pets, 'target' => "Any Pet"]);
            } else return redirect()->back()->with('message', 'Please allow us to process your pending applications before applying again.');
        } else return route('login');
    }

    public function postForm(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'email' => 'required|email',
            'phone' => 'required',
            'address_line_1' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'state' => 'required',
            'answer_1' => 'required|max:500',
            'answer_2' => 'required|max:500',
            'answer_3' => 'required|max:300',
            'urgency' => 'required',
        ]);

        $user = Auth::user();

            $form = new AdoptionForm([
                'user_id' => $user->id,
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address_line_1' => $request->input('address_line_1'),
                'address_line_2' => $request->input('address_line_2'),
                'city' => $request->input('city'),
                'zip' => $request->input('zip'),
                'state' => $request->input('state'),
                'answer_1' => $request->input('answer_1'),
                'answer_2' => $request->input('answer_2'),
                'answer_3' => $request->input('answer_3'),
                'urgency' => $request->input('urgency'),
                'pet_name' => $request->input('pet'),
                'status' => "Pending"
            ]);

            $form->save();
            return redirect()->route('get-success');
    }

    public function getApplyAdoptForm($name)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (count($user->adoptForms) < 3) {
                $pets = Pet::where('status', '=', 'available')->get();
                return view('adopt/form', ['pets' => $pets, 'name' => $name]);
            } else return redirect()->back()->with('message', 'Please allow us to process your pending applications before applying again.');
        } else return route('login');
    }

    public function getEditAdoptForm($id)
    {
        $form = AdoptionForm::find($id);
        $pets = Pet::where('status', '=', 'available')->get();
        return view('adopt/edit', ['form' => $form, 'pets' => $pets]);
    }

    public function postAdoptFormEdit(Request $request){
        $this->validate($request, [
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'email' => 'required|email',
            'phone' => 'required',
            'address_line_1' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'state' => 'required',
            'answer_1' => 'required|max:500',
            'answer_2' => 'required|max:500',
            'answer_3' => 'required|max:300',
            'urgency' => 'required',
        ]);

        $user = Auth::user();
        $form_id = $request->input('form_id');
        $form = AdoptionForm::find($form_id);

        $form ->update([
            'user_id' => $user->id,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address_line_1' => $request->input('address_line_1'),
            'address_line_2' => $request->input('address_line_2'),
            'city' => $request->input('city'),
            'zip' => $request->input('zip'),
            'state' => $request->input('state'),
            'answer_1' => $request->input('answer_1'),
            'answer_2' => $request->input('answer_2'),
            'answer_3' => $request->input('answer_3'),
            'urgency' => $request->input('urgency'),
            'pet_name' => $request->input('pet'),
            'status' => "Pending"
        ]);

        $form->save();
        return redirect()->route('get-success');
    }

//    ------------------------------------- Foster Form

    public function getFosterForm()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (count($user->fosterForms) < 3) {
                $pets = Pet::where('status', '=', 'available')->get();
                return view('adopt/foster-form', ['pets' => $pets]);
            } else
                return redirect()->back()->with('message', 'Please allow us to process your pending applications before applying again.');
        } else
            return view('user/sign-in');
    }

    public function postFosterForm(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'email' => 'required|email',
            'phone' => 'required',
            'address_line_1' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'state' => 'required',
            'answer_1' => 'required|max:500',
            'answer_2' => 'required|max:500',
            'answer_3' => 'required|max:300',
            'urgency' => 'required',
            'duration' => 'required',
        ]);

        if (Auth::check()) {
            $user_id = Auth::user()->id;
        } else {
            return redirect()->route('login');
        }

        $form = new FosterForm([
            'user_id' => $user_id,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address_line_1' => $request->input('address_line_1'),
            'address_line_2' => $request->input('address_line_2'),
            'city' => $request->input('city'),
            'zip' => $request->input('zip'),
            'state' => $request->input('state'),
            'answer_1' => $request->input('answer_1'),
            'answer_2' => $request->input('answer_2'),
            'answer_3' => $request->input('answer_3'),
            'urgency' => $request->input('urgency'),
            'duration' => $request->input('duration'),
            'pet_name' => $request->input('pet'),
            'status' => "Pending"
        ]);

        $form->save();
        return redirect()->route('get-success');
    }

    public function getEditFosterForm($id)
    {
        $form = FosterForm::find($id);
        $pets = Pet::where('status', '=', 'available')->get();
        return view('adopt/foster-edit', ['form' => $form, 'pets' => $pets]);
    }

    public function getFosterInfo()
    {
        return view('adopt/foster-info');
    }

    public function postFosterFormEdit(Request $request){
        $this->validate($request, [
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'email' => 'required|email',
            'phone' => 'required',
            'address_line_1' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'state' => 'required',
            'answer_1' => 'required|max:500',
            'answer_2' => 'required|max:500',
            'answer_3' => 'required|max:300',
            'urgency' => 'required',
            'duration' => 'required',
        ]);

        if (Auth::check()) {
            $user_id = Auth::user()->id;
        } else {
            return redirect()->route('login');
        }

        $form_id = $request->input('form_id');
        $form = FosterForm::find($form_id);

        $form ->update([
            'user_id' => $user_id,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address_line_1' => $request->input('address_line_1'),
            'address_line_2' => $request->input('address_line_2'),
            'city' => $request->input('city'),
            'zip' => $request->input('zip'),
            'state' => $request->input('state'),
            'answer_1' => $request->input('answer_1'),
            'answer_2' => $request->input('answer_2'),
            'answer_3' => $request->input('answer_3'),
            'urgency' => $request->input('urgency'),
            'duration' => $request->input('duration'),
            'pet_name' => $request->input('pet'),
            'status' => "Pending"
        ]);

        $form->save();
        return redirect()->route('get-success');
    }

    public function getSuccess()
    {
        return view('adopt/success');
    }
}
