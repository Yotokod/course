<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of purchases.
     */
    public function index()
    {
        $purchases = Purchase::with('user', 'module')->latest()->paginate(20);
        return view('admin.purchases.index', compact('purchases'));
    }

    /**
     * Display the specified purchase.
     */
    public function show(Purchase $purchase)
    {
        $purchase->load('user', 'module');
        return view('admin.purchases.show', compact('purchase'));
    }
}
