<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TechUser;

class TechUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $techUsers = TechUser::all();
        return $techUsers;
    }

    public function findOrCreate(Request $request)
    {
        try {
            $data = $request->json()->all();

            $firebaseId = $data['firebaseId'];
            $firebaseName = $data['firebaseName'];

            $techUser = TechUser::firstOrCreate(
                ['firebaseId' => $firebaseId], ['firebaseName' => $firebaseName]
            );
            return $techUser->id;
        }
        catch(Exception $e) {
            return array("status" => "EXCEPTION ERROR");
        }
    }
}
