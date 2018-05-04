<?php

namespace App\Http\Controllers;

use App\Places;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class PagesController extends Controller
{
    //
    

    public function index()
    {
        if(Auth::check())
        {
            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            if($user->companies)
            {
                return view('home')->with(['user' => $user, 'companies' => $user->companies, 'home' => 'active']);
            }
            elseif($user->people)
            {
                return view('home')->with(['user' => $user, 'people' => $user->people, 'home' => 'active']);
            }
        }
        else{
            return view('pages.index');
        }
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
