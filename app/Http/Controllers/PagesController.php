<?php

namespace App\Http\Controllers;

use App\Places;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //

    public function index()
    {
        return view('pages.index');
    }

    public function register()
    {
        $places = Places::all();

        return view('pages.register')->with('places', $places);
    }

    public function login()
    {
        return view('pages.login');
    }

}
