<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Companies;
use App\Places;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Support\Facades\App;
use League\Flysystem\Exception;

class CompaniesController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $user = new User;
        $company = new Companies;
        
        $message = "";
        $places = Places::all();
        $data = [
            'name' => request('company'),
            'website' => request('website'),
            'workarea' => request('workArea'),
            'firstName' => request('firstNameContact'),
            'lastName' => request('lastNameContact'),
            'country' => request('country'),
            'email' => request('email')
        ];

        DB::beginTransaction();
        try
        {
            $this->validate(request(), [
                'company' => 'required|regex:/^([A-Za-z áéíóúÁÉÍÓÚñÑ.,])*$/',
                'website' => 'required|url',
                'workArea' => 'required|regex:/^([a-zA-Z áéíóúÁÉÍÓÚñÑ])*$/',
                'firstNameContact' => 'required|regex:/^([a-zA-Z áéíóúÁÉÍÓÚñÑ])*$/',
                'lastNameContact' => 'required|regex:/^([a-zA-Z áéíóúÁÉÍÓÚñÑ])*$/',
                'country' => 'exists:places,PL_Name',
                'email' => 'required|email|unique:users,US_Email',
                'password' => 'required|same:repeatPassword',
                'repeatPassword' => 'required',
                'termsAndConditions' => 'accepted'
            ]);

            $user = User::create([
                'US_Email' => request('email'),
                'US_Password' => bcrypt(request('password')),
                'US_isCompany' => 0
            ]);

            $company = Companies::create([
                'CO_Name' => request('company'),
                'CO_ContactName' => request('firstNameContact'),
                'CO_ContactLastName' => request('lastNameContact'),
                'CO_Website' => request('website'),
                'CO_WorkArea' => request('workArea'),
                'CO_FK_US' => $user->id,
                'CO_FK_PL' => Places::where('PL_Name', request('country'))->first()->PL_id
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
            else {
                $message = "Something went wrong. Try again.";
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
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function edit(Companies $companies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companies $companies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $companies)
    {
        //
    }
}
