<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use App\Models\TicketReply;
use Illuminate\Http\Request;

class TicketReplyController extends Controller
{

    /**
     * Store a new reply from user
     */
    public function store(Request $request, SupportTicket $ticket)
    {
        // فقط صاحب تیکت اجازه پاسخ دارد
        abort_if(
            $ticket->user_id !== auth()->id(),
            403
        );


        $request->validate([
            'message' => 'required|string|min:3',
        ]);



        TicketReply::create([

            'ticket_id' => $ticket->id,

            'user_id' => auth()->id(),

            'message' => $request->message,

            'is_admin' => false,

        ]);



        // اگر کاربر دوباره پیام داد، تیکت باز شود
        $ticket->update([
            'status' => 'open'
        ]);



        return back()->with(
            'success',
            'Reply sent successfully.'
        );
    }



    /**
     * Delete reply (optional)
     */
    public function destroy(TicketReply $reply)
    {

        abort_if(
            $reply->user_id !== auth()->id(),
            403
        );


        $reply->delete();


        return back()->with(
            'success',
            'Reply deleted.'
        );
    }

}