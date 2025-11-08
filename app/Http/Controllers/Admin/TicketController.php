<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::with('user')->latest()->paginate(15);
        return view('admin.tickets.index', compact('tickets'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $ticket->load('user');
        return view('admin.tickets.show', compact('ticket'));
    }

    /**
     * Update the ticket response.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'admin_response' => 'required|string',
            'status' => 'required|in:open,closed',
        ]);

        $ticket->update($validated);

        return redirect()->route('admin.tickets.show', $ticket)
            ->with('success', 'Réponse envoyée avec succès!');
    }

    /**
     * Close the ticket.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->update(['status' => 'closed']);

        return redirect()->route('admin.tickets.index')
            ->with('success', 'Ticket fermé avec succès!');
    }
}
