<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Exception;

//add
use App\Ticket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tickets = Ticket::with('techTicketHandler.techUser')->get();
        return $tickets;
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
            $ticket = new Ticket;

            $ticket->userID = $request->userID;
            $ticket->operatingSystem = $request->operatingSystem;
            $ticket->issue = $request->issue;
            $ticket->status = $request->status;
            $ticket->description = $request->description;

            $saved = $ticket->save();

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
        $ticket= Ticket::find($email);
        return $ticket;
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
            $ticket = Ticket::find($id);
            $ticket->userID = $request->userID;
            $ticket->operatingSystem = $request->operatingSystem;
            $ticket->issue = $request->issue;
            $ticket->status = $request->status;
            $ticket->description = $request->description;

            $saved = $ticket->save();

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
            $ticket = Ticket::find($id);
            if ($ticket != null) {
                $ticket->delete();
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
