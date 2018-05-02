<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\People;
use App\Companies;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if($user->companies)
        {
            return view('home')->with(['companies' => $user->companies, 'home' => 'active']);
        }
        elseif($user->people)
        {
            return view('home')->with(['people' => $user->people, 'home' => 'active']);
        }
    }

    public function settings()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if($user->companies)
        {
            return view('pages.settings')->with(['companies' => $user->companies, 'settings' => 'active']);
        }
        elseif($user->people)
        {
            return view('pages.settings')->with(['people' => $user->people, 'settings' => 'active']);
        }
        
    }
}
