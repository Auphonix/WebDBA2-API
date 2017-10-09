<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TechUser;
use App\TechTicketHandler;
use App\Ticket;

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

    public function assignToTicket(Request $request)
    {
        try {
            // TODO: Doesn't use validation, very unsafe
            $data = $request->json()->all();

            $handler = new TechTicketHandler();

            // Set tech user and ticket
            $techUser = TechUser::find($data['techUserID']);
            $handler->techUserID = $techUser->id;
            // Update ticket with priority and escalation level
            $ticket = Ticket::find($data['ticketID']);
            $ticket->priority = $data['priority'];
            $ticket->escalationLevel = $data['escalationLevel'];
            $handler->ticketID = $ticket->id;

            // TODO: Need to prevent saving the same TechTicketHandler multiple times

            // Save ticket and tech ticket handler
            if(!$handler->save() || !$ticket->save()){
                return array("status" => "NO_SAVE ERROR");
            }

            return array("status" => "SUCCESS");
        }
        catch(Exception $e) {
            return array("status" => "EXCEPTION ERROR");
        }
    }

    public function tickets(Request $request, $id)
    {
        $techUser = TechUser::find($id);

        $tickets = [];
        foreach ($techUser->techTicketHandlers as $handler) {
            array_push($tickets, $handler->ticket);
        }
        return $tickets;
    }
}
