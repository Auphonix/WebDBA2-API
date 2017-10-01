<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Exception;

//add
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users= User::all();
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = new User;

            $user->firstName = $request->firstName;
            $user->lastName = $request->lastName;
            $user->email = $request->email;
            $user->isAdmin = $request->isAdmin;
            $user->password = $request->password;

            $saved = $user->save();

            if(!$saved){
                return array("status" => "NO_SAVE ERROR");
            }
        }

        catch(Exception $e) {
            return array("status" => "EXCEPTION ERROR");
        }

        return array("status" => "SUCCESS");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        $user= User::find($email);
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $user->firstName = $request->firstName;
            $user->lastName = $request->lastName;
            $user->email = $request->email;
            $user->isAdmin = $request->isAdmin;
            $user->password = $request->password;

            $saved = $user->save();

            if(!$saved){
                return array("status" => "NO_SAVE ERROR");
            }
        }
        catch(Exception $e) {
            return array("status" => "EXCEPTION ERROR");
        }

        return array("status" => "SUCCESS");;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if ($user != null) {
                $user->delete();
            } else {
                return array("status" => "ERROR");
            }
        }
        catch(Exception $e) {
            return array("status" => "EXCEPTION ERROR");
        }

        return array("status" => "SUCCESS");;
    }
}
