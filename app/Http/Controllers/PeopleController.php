<?php

namespace App\Http\Controllers;

use App\People;
use App\Places;
use App\User;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Exception;
use Illuminate\Database\QueryException;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd(request()->all());
        $message = 'There was an error, try again';
        $places = Places::all();
        $data = [
            'name' => request('firstName'),
            'lastName' => request('lastName'),
            'country' => request('country'),
            'email' => request('email')
        ];

        try
        {
            if(request('checkboxTC_P') == 'on')
            {
                $user = new User;
                $people = new People;

                //User
                $user->US_Email = request('email');
                $user->US_Password = request('pwd');
                $user->US_isCompany = 0;
                $repeatPassword = request('repeatPwd');

                if($user->save())
                {
                    $people->PE_Name = request('firstName');
                    $people->PE_LastName = request('lastName');
                    $people->PE_FK_US = $user->id;
                    $people->PE_FK_PL = Places::where('PL_Name', request('country'))->first()->PL_id;

                    if($people->save())
                    {
                        return view('pages.register')->with(['places' => $places]);
                    }
                }
            }
            else {
                $message = "You need to agree with our terms and conditions in order to register an account";
                return view('pages.register')->with(['error' => $message, 'places' => $places]);
            }
        }
        catch(QueryException $e) {
            if($e->errorInfo[1] == 1062)
            {
                $message = 'This email already exists. Try with a different one';
            }
            elseif($e->errorInfo[1] == 1048)
            {
                $message = "You can't leave empty fields.";
            }
            return view('pages.register')->with(['error' => $message, 'places' => $places, 'data' => [$data]]);
        }

        //People

        //return redirect("/register");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show(People $people)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit(People $people)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, People $people)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy(People $people)
    {
        //
    }
}
