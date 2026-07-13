<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;

class SupportTicketController extends Controller
{

    public function index()
    {
        $tickets = SupportTicket::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('support-index', compact('tickets'));
    }


    public function create()
    {
        return view('support.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);


        SupportTicket::create([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'message' => $request->message,
            'priority' => $request->priority,
        ]);


        return redirect()
            ->route('support.index')
            ->with('success', 'Ticket created successfully.');
    }


    public function show(SupportTicket $ticket)
    {
        abort_if(
            $ticket->user_id !== auth()->id(),
            403
        );

        return view('support-show', compact('ticket'));
    }


    public function close(SupportTicket $ticket)
    {
        abort_if(
            $ticket->user_id !== auth()->id(),
            403
        );


        $ticket->update([
            'status' => 'closed'
        ]);


        return back()
            ->with('success', 'Ticket closed.');
    }
}