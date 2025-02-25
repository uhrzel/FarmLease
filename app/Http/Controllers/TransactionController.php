<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;

class TransactionController extends Controller
{
    public function transactions()
    {
        // Fetch all transactions with land listing details
        $transactions = Cart::with('landListing', 'user')->get();

        // Log data for debugging
        Log::info('Transactions Retrieved:', ['transactions' => $transactions]);

        return view('users.superadmin.transactions', compact('transactions'));
    }
}
