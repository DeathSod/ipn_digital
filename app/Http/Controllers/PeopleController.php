<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\People;
use App\Places;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Support\Facades\App;
use League\Flysystem\Exception;

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
        $user = new User;
        $people = new People;
        
        $message = "";
        $places = Places::all();
        $data = [
            'name' => request('firstName'),
            'lastName' => request('lastName'),
            'country' => request('country'),
            'email' => request('email')
        ];

        dd($data);
        DB::beginTransaction();
        try
        {
            $this->validate(request(), [
                'firstName' => 'required|regex:/^([a-zA-Z áéíóúÁÉÍÓÚñÑ])*$/',
                'lastName' => 'required|regex:/^([a-zA-Z áéíóúÁÉÍÓÚñÑ])*$/',
                'email' => 'required|email|unique:users,email',
                'country' => 'exists:places,PL_Name',
                'password' => 'required|confirmed|min:8',
                'password_confirmation' => 'required',
                'termsAndConditions' => 'accepted'
            ]);

            $user = User::create([
                'email' => request('email'),
                'password' => bcrypt(request('password')),
                'US_isCompany' => 0
            ]);

            $people = People::create([
                'PE_Name' => request('firstName'),
                'PE_LastName' => request('lastName'),
                'PE_FK_US' => $user->id,
                'PE_FK_PL' => Places::where('PL_Name', request('country'))->first()->PL_id
            ]);

            DB::commit();

            $message = "<strong>Congratulations!</strong> You can now <a href='/login'>log in</a>";
            return redirect()->back()->with(['success' => $message, 'places' => $places]);

        }
        catch(QueryException $qe)
        {

            if($qe->errorInfo[1] == 1062)
            {
                $message = 'This email already exists. Try with a different one';
            }
            elseif($qe->errorInfo[1] == 1048)
            {
                $message = "You can't leave empty fields.";
            }
            DB::rollBack();
            return view('pages.register')->with(['error' => $message, 'places' => $places, 'data' => [$data]]);
        }
        catch(Exception $e)
        {
            DB::rollBack();
            $message = "Something went wrong. Try again.";
            return view("pages.register")->with(["error" => $message, "places" => $places, "data" => [$data]]);
        }
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
