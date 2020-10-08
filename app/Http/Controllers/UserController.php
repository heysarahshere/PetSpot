<?php

namespace App\Http\Controllers;

use App\Donation;
use App\FosterForm;
use App\Post;
use App\Alert;
use App\AdoptionForm;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{

    public function getSignUp()
    {
        return view('user/sign-up');
    }

    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'userName' => 'required|min:3|unique:users',
            'firstName' => 'required|min:3',
            'lastName' => 'required|min:3',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = new User([
            'userName' => $request->input('userName'),
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        $user->save();

        Auth::login($user);



        if ($request->has('sign-in-page')) {
            return redirect()->route('profile')->with('message', "You're signed in.");
        } else {
            return redirect()->back()->with('message', "You're signed in.");
        }
    }

    public function getSignIn()
    {
        return view('user/sign-in');
    }

    public function getModeratedForums()
    {
        return view('user/moderated');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])) {

            $user = Auth::user();
            Auth::login($user);

//            $request->session()->forget('sign-in-error');

            if ($request->has('sign-in-page')) {
                return redirect()->route('profile')->with('message', "You're signed in.");
            } else {
                return redirect()->back()->with('message', "You're signed in.");
            }
        }

        return redirect('user/sign-in')
            ->with('message', 'Incorrect username or password.');
    }

    public function postSignOut(Request $request)
    {
        Auth::logout();
        return redirect()
            ->route('index')
            ->with('message', "You've been signed out.");
    }

    public function getProfile()
    {
        if(Auth::check()){
            $user = Auth::user();
            $user_id = $user->id;

            $donations = Donation::where('user_id', $user_id)->get();
            $posts = Post::where('user_id', $user_id)->limit(10)->get();
            $adoptionForms = AdoptionForm::where('user_id', $user_id)->get();
            $fosterForms = FosterForm::where('user_id', $user_id)->get();
            $alerts = Alert::where('user_id', $user_id)->get();


            return view('user/profile')
                ->with([
                    'user' => $user,
                    'donations' => $donations,
                    'posts' => $posts,
                    'adoptionForms' => $adoptionForms,
                    'fosterForms' => $fosterForms,
                    'alerts' => $alerts
                ]);
        } else {
            return redirect()->route('login')->with('message', 'You must be logged in to do that.');
        }

    }

    public function getPublicProfile($username)
    {
        $user = User::where('userName', $username)->with('posts')->first();
        if($user){
            $posts = Post::where('user_id', $user->id)->get();
            return view('user/public-profile')
                ->with([
                    'user' => $user,
                    'posts' => $posts,
                ]);
        } else {
            return redirect()->back()->with('message', 'That user\'s profile wasn\'t found.');
        }
    }

    public function postChangePassword(Request $request){
        $this->validate($request, [
            'old_password' => 'required|confirmed|min:6',
            'old_password_confirmation' => 'required',
            'new_password' => 'required',
        ]);

        if(Auth::check()){
            $user = Auth::user();
            $old_pass = $request->input('old_password');
            $new_pass = $request->input('new_password');
            if (!(Hash::check($old_pass, $user->password))) {
                // The passwords not matches
                //return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
                return response()->json(['errors' => ['current'=> ['Current password does not match']]], 422);
            } else {
                $user->password = bcrypt($new_pass);
                $user->save();
                return redirect()->back()->with('message', 'Password Updated.');
            }
        }
    }

    public function getUpdateProfile() {
        $user = Auth::user();
        return view('user/update')
            ->with([
                'user' => $user
                // add adoption form stuff
            ]);
    }

    public function putUpdateProfile(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'userName' => 'required',
            'email' => 'required|email',
        ]);

        if(Auth::check()){
            $user = Auth::user();
            $user->firstName = $request->input('firstName');
            $user->lastName = $request->input('lastName');
            $user->userName = $request->input('userName');
            $user->email = $request->input('email');
            if($request->input('bio') != ''){
                $user->bio = $request->input('bio');
            }

            if ($request->has('profile_image')) {
                $file = $request->file('profile_image');
                $filename = $request->input('firstName') . $request->input('lastName') . "." . $file->getClientOriginalExtension();  // multiple extension types
                if($request->hasFile('profile_image')){
                    if($user->profile_image != 'empty_profile.png'){
                        Storage::disk('s3')->delete($user->profile_image);
                    }
                    Storage::disk('s3')->put($filename, File::get($file));
                    $user->profile_image = $filename;
                }
            }

            $user->save();
            return redirect()->route('profile');
        }

    }
}
