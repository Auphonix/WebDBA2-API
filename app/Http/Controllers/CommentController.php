<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

use Exception;

//add
use App\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comments= Comment::all();
        return $comments;
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
            $comment = new Comment;

            $comment->ticketID = $request->ticketID;
            $comment->userID = $request->userID;
            $comment->content = $request->content;

            $saved = $comment->save();

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
        $comment= Comment::find($email);
        return $comment;
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
            $comment = Comment::find($id);
            $comment->ticketID = $request->ticketID;
            $comment->userID = $request->userID;
            $comment->content = $request->content;

            $saved = $comment->save();

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
            $comment = Comment::find($id);
            if ($comment != null) {
                $comment->delete();
            } else {
                return array("status" => "ERROR");
            }
        }
        catch(Exception $e) {
            return array("status" => "EXCEPTION ERROR");
        }

        return array("status" => "SUCCESS");;
    }

    // Return all comments for a ticket
    public function getComments($id)
    {
        $comments = Comment::with('ticket')->where('ticketID', $id)->get();
        return $comments;
    }
}
