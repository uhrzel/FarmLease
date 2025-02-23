<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\LandListing;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'land_listing_id' => 'required|exists:land_listings,id',
            ]);

            $user = Auth::user();
            $landListing = LandListing::findOrFail($request->land_listing_id);
            $transaction = Transaction::where('land_listing_id', $landListing->id)->first();

            if (!$transaction) {
                return response()->json(['message' => 'No transaction found for this listing.'], 404);
            }
            if (Cart::where('user_id', $user->id)->where('land_listing_id', $landListing->id)->exists()) {
                Log::info('Attempt to add duplicate cart item', ['user_id' => $user->id, 'land_listing_id' => $landListing->id]);
                return response()->json(['message' => 'This land is already in your cart.'], 409);
            }
            $cart = Cart::create([
                'user_id' => $user->id,
                'land_listing_id' => $landListing->id,
                'transaction_id' => $transaction->id,
                'total_payment' => $landListing->price,
                'status' => 'pending',
            ]);

            Log::info('Land added to cart successfully', ['cart_id' => $cart->id, 'user_id' => $user->id]);

            return response()->json(['message' => 'Land added to cart successfully!', 'cart' => $cart], 200);
        } catch (\Exception $e) {
            Log::error('Error adding land to cart', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['message' => 'An error occurred while adding to cart.'], 500);
        }
    }
    public function index()
    {
        $carts = Cart::with(['landListing.owner'])
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->get();

        return view('users.tenant.cart_index', compact('carts'));
    }
}
