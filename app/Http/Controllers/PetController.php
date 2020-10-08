<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Pet;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Str;

class PetController extends Controller
{

    public function getAllPets()
    {
        session()->put('showSearch', true);
        $pets = Pet::orderBy('updated_at', 'desc')->paginate(8);
        return view('kennel/adoptable', ['pets' => $pets, 'category' => "All Pets"]);
    }

    public function getDogs()
    {
        session()->put('showSearch', true);
        $pets = Pet::where('species', 'dog')->orderBy('updated_at', 'desc')->paginate(8);
        return view('kennel/adoptable', ['pets' => $pets, 'category' => "Dogs"]);
    }

    public function getCats()
    {
        session()->put('showSearch', true);
        $pets = Pet::where('species', 'cat')->orderBy('updated_at', 'desc')->paginate(8);
        return view('kennel/adoptable', ['pets' => $pets, 'category' => "Cats"]);
    }

    public function getAvailable()
    {
        session()->put('showSearch', true);
        $pets = Pet::where('status', 'available')->orderBy('updated_at', 'desc')->paginate(8);
        return view('kennel/adoptable', ['pets' => $pets, 'category' => "Available"]);
    }

    public function getAddPet() {
        return view('kennel/add');
    }

    public function postAddPet(Request $request) {
        $this->validate($request, [
            'name' =>  'required|max:60',
            'description' =>  'required|max:500',
            'species' =>  'required',
            'gender' =>  'required',
            'size' =>  'required',
            'shedInput' =>  'required',
            'furInput' =>  'required'
        ]);

        $pet = new Pet([
            'name' =>  $request->input('name'),
            'description' =>  $request->input('description'),
            'species' =>  $request->input('species'),
            'breed' =>  $request->input('breed'),
            'gender' =>  $request->input('gender'),
            'size' =>  $request->input('size'),
            'age' =>  $request->input('age'),
            'weight' =>  $request->input('weight'),
            'status' =>  $request->input('status'),
            'fur_level' =>  $request->input('furInput')
        ]);
        // erase any whitespace in name first
        if($request->input('add_image1') == true) {
            $file = $request->file('image1');
            $filename = $request->input('name') . '1.' . $file->getClientOriginalExtension();  // multiple extension types
            if($request->hasFile('image1')){
                Storage::disk('s3')->put($filename, File::get($file));
                $pet->image1_url = $filename;
            }
        }
        if($request->input('add_image2') == true){
            $file2 = $request->file('image2');
            $filename2 = $request->input('name') . '2.' . $file2->getClientOriginalExtension();  // multiple extension types
            if($request->hasFile('image2')){
                Storage::disk('s3')->put($filename2, File::get($file2));
                $pet->image2_url = $filename2;
            }
        }
        if($request->input('add_image3') == true){
            $file3 = $request->file('image3');
            $filename3 = $request->input('name') . '3.' . $file3->getClientOriginalExtension();  // multiple extension types
            if($request->hasFile('image3')){
                Storage::disk('s3')->put($filename3, File::get($file3));
                $pet->image3_url = $filename3;
            }
        }
        $pet->save();

        // traits
        $personality = new Attribute([
            'pet_id' => $pet->id,
            'friendly' =>  $request->input('friendly') == 'true' ? "friendly" : null,
            'energetic' =>  $request->input('energetic') == 'true' ? "energetic" : null,
            'calm' =>  $request->input('calm') == 'true' ? "calm" : null,
            'good_with_kids' =>  $request->input('goodWithKids') == 'true' ? "good with kids" : null,
            'drools' =>  $request->input('drools') == 'true' ? "drooler" : null,
            'escape_artist' =>  $request->input('escapeArtist') == 'true' ? "escape artist" : null,
            'special_needs' =>  $request->input('specialNeeds') == 'true' ? "special needs" : null,
            'vocal' =>  $request->input('vocal') == 'true' ? "vocal" : null,
            'trained' =>  $request->input('trained') == 'true' ? "trained" : null,
            'novice_owner_ok' =>  $request->input('noviceOwnerOk') == 'true' ? 'novice owner ok' : null,
            'aggressive_toward_humans' =>  $request->input('aggHumans') == 'true' ? 'timid with new people' : null,
            'aggressive_toward_cats' =>  $request->input('aggCats') == 'true' ? 'dislikes cats' : null,
            'aggressive_toward_dogs' =>  $request->input('aggDogs') ==  'true' ? 'dislikes dogs' : null,
            'aggressive_toward_kids' =>  $request->input('aggKids') == 'true' ? 'dislikes kids': null,
            'shed_level' =>  $request->input('shedInput'),
        ]);
        $personality->save();

        return redirect('kennel/adoptable');
    }

    public function postDeletePet($id) {
        $pet = Pet::find($id);
        $pet->delete();
        return redirect('kennel/adoptable');
    }

    public function getPetDetails($id)
    {

        $pet = Pet::find($id);
        $pet_traits = Attribute::where('pet_id', $id)->first();
        if($pet->fur_level === "1"){
            $fur_length = "short";
        } else if($pet->fur_level === "2"){
            $fur_length = "medium length";
        } else if($pet->fur_level === "3") {
            $fur_length = "long";
        } else {
            $fur_length = "unknown";}

        return view('kennel/details', [
            'pet' => $pet,
            'pet_traits' => $pet_traits,
            'fur_length' => $fur_length
        ]);
    }

    public function postUpdatePet(Request $request, $id)
    {

        $this->validate($request, [
            'name' =>  'required|max:60',
            'description' =>  'required|max:500',
            'species' =>  'required',
            'gender' =>  'required',
            'size' =>  'required',
            'shedInput' =>  'required',
            'furInput' =>  'required'
        ]);

        // find and update old pet instead
        $pet = Pet::find($id);
        $pet->update([
            'name' =>  $request->input('name'),
            'description' =>  $request->input('description'),
            'species' =>  $request->input('species'),
            'breed' =>  $request->input('breed'),
            'gender' =>  $request->input('gender'),
            'size' =>  $request->input('size'),
            'age' =>  $request->input('age'),
            'weight' =>  $request->input('weight'),
            'status' =>  $request->input('status'),
            'fur_level' =>  $request->input('furInput')
        ]);
        // erase any whitespace in name first
        if($request->input('add_image1') == true) {
            $file = $request->file('image1');
            $filename = $request->input('name') . '1.' . $file->getClientOriginalExtension();  // multiple extension types
            if($request->hasFile('image1')){
                Storage::disk('s3')->put($filename, File::get($file));
                $pet->image1_url = $filename;
            }
        }
        if($request->input('add_image2') == true){
            $file2 = $request->file('image2');
            $filename2 = $request->input('name') . '2.' . $file2->getClientOriginalExtension();  // multiple extension types
            if($request->hasFile('image2')){
                Storage::disk('s3')->put($filename2, File::get($file2));
                $pet->image2_url = $filename2;
            }
        }
        if($request->input('add_image3') == true){
            $file3 = $request->file('image3');
            $filename3 = $request->input('name') . '3.' . $file3->getClientOriginalExtension();  // multiple extension types
            if($request->hasFile('image3')){
                Storage::disk('s3')->put($filename3, File::get($file3));
                $pet->image3_url = $filename3;
            }
        }

        $pet->save();

        // traits
        $personality = Attribute::where('pet_id', $id)->first();
        $personality->update([
            'pet_id' => $pet->id,
            'friendly' =>  $request->input('friendly') == 'true' ? "friendly" : null,
            'energetic' =>  $request->input('energetic') == 'true' ? "energetic" : null,
            'calm' =>  $request->input('calm') == 'true' ? "calm" : null,
            'good_with_kids' =>  $request->input('goodWithKids') == 'true' ? "good with kids" : null,
            'drools' =>  $request->input('drools') == 'true' ? "drooler" : null,
            'escape_artist' =>  $request->input('escapeArtist') == 'true' ? "escape artist" : null,
            'special_needs' =>  $request->input('specialNeeds') == 'true' ? "special needs" : null,
            'vocal' =>  $request->input('vocal') == 'true' ? "vocal" : null,
            'trained' =>  $request->input('trained') == 'true' ? "trained" : null,
            'novice_owner_ok' =>  $request->input('noviceOwnerOk') == 'true' ? 'novice owner ok' : null,
            'aggressive_toward_humans' =>  $request->input('aggHumans') == 'true' ? 'timid with new people' : null,
            'aggressive_toward_cats' =>  $request->input('aggCats') == 'true' ? 'dislikes cats' : null,
            'aggressive_toward_dogs' =>  $request->input('aggDogs') ==  'true' ? 'dislikes dogs' : null,
            'aggressive_toward_kids' =>  $request->input('aggKids') == 'true' ? 'dislikes kids': null,
            'shed_level' =>  $request->input('shedInput'),
        ]);
        $personality->save();

        return redirect('kennel/adoptable');
    }

    public function getUpdatePet($id)
    {
        $pet = Pet::find($id);
        $pet_traits = Attribute::where('pet_id', $id)->first();
        return view('kennel/update', ['pet' => $pet, 'pet_traits' => $pet_traits]);
    }

    public function search(Request $request) {
            $q = $request->input('q');
            $pets = Pet::where('name','LIKE','%'.$q.'%')
                ->orWhere('species','LIKE','%'.$q.'%')
                ->orWhere('gender','LIKE','%'.$q.'%')
                ->orWhere('breed','LIKE','%'.$q.'%')
                ->orWhere('size','LIKE','%'.$q.'%')
                ->orWhere('age','LIKE','%'.$q.'%')
                ->paginate(100);

            return view('kennel/adoptable', ['pets' => $pets, 'q' => $q, 'category' => 'Results for: '.$q ])
                ->with('message', 'Results for: '.$q);

    }

    public function refineSearch(Request $request) {

        $age = $request->input('age');
        $gender = $request->input('gender');
        $fur = $request->input('fur');
        $species = $request->input('species');

        session()->put('showSearch', true);

        $pets = Pet::where('age', 'LIKE', '%'.$age.'%')
            ->where('gender', 'LIKE', $gender)
            ->where('fur_level', 'LIKE', '%'.$fur.'%')
            ->where('species', 'LIKE', '%'.$species.'%')
            ->paginate(100);

        if($fur === '1'){
            $hair = "short";
        } else if($fur === '2'){
            $hair = "medium";
        } else if($fur === '3'){
            $hair = "long";
        } else { $hair = "any"; }



        $q = 'Age: '.Str::lower($age). ' | Species: '.Str::lower($species) .' | Gender: ' .Str::lower($gender).' | Fur: '.Str::lower($hair);



            return view('kennel/adoptable', ['pets' => $pets, 'category' => "Refined Results", 'q' => $q ]);

    }
}
