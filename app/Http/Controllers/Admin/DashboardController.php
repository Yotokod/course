<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\User;
use App\Models\Purchase;
use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_modules' => Module::count(),
            'total_users' => User::where('role', 'client')->count(),
            'total_purchases' => Purchase::where('payment_status', 'completed')->count(),
            'open_tickets' => Ticket::where('status', 'open')->count(),
            'revenue' => Purchase::where('payment_status', 'completed')->sum('amount'),
        ];

        $recent_modules = Module::with('creator')->latest()->take(5)->get();
        $recent_tickets = Ticket::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_modules', 'recent_tickets'));
    }
}
