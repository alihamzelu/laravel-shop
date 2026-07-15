<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use App\Models\TicketReply;
use Illuminate\Http\Request;

class TicketReplyController extends Controller
{
    public function store(Request $request, SupportTicket $ticket)
    {
        abort_if($ticket->user_id !== auth()->id(), 403);

        $request->validate([
            'message' => 'required|string|min:3',
        ]);

        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id'   => auth()->id(),
            'message'   => $request->message,
            'is_admin'  => false,
        ]);

        $ticket->update(['status' => 'open']);

        return back()->with('success', 'Reply sent successfully.');
    }
}