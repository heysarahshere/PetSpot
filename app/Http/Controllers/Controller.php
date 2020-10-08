<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function getIndex() {
        return view('index');
    }

    public function getAbout() {
        return view('about');
    }

    public function getBlog() {
        return view('blog');
    }

    public function getContact() {
        return view('contact');
    }

    public function getErrorNotFound() {
        return view('errors/404-not-found');
    }
}
