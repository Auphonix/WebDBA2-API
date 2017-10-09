<?php

namespace App\Http\Controllers;

use App\TechTicketHandler;
use App\TechUser;
use App\Ticket;
use Illuminate\Http\Request;

class TechTicketHandlerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->json()->all();

            $handler = new TechTicketHandler();

            // Set tech user and ticket
            $techUser = TechUser::find($data['techUserID']);
            $handler->techUserID = $techUser->id;
            $ticket = Ticket::find($data['ticketID']);
            $handler->ticketID = $ticket->id;

            // TODO: Need to prevent saving the same TechTicketHandler multiple times

            $saved = $handler->save();

            if(!$saved){
                return array("status" => "NO_SAVE ERROR");
            }

            return array("status" => "SUCCESS");
        }
        catch(Exception $e) {
            return array("status" => "EXCEPTION ERROR");
        }
    }
}
