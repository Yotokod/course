<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of user's tickets.
     */
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new ticket.
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created ticket.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'open';

        Ticket::create($validated);

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket créé avec succès! Notre équipe vous répondra bientôt.');
    }

    /**
     * Display the specified ticket.
     */
    public function show(Ticket $ticket)
    {
        // Ensure user can only see their own tickets
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        return view('tickets.show', compact('ticket'));
    }
}
