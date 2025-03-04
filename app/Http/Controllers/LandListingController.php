<?php

namespace App\Http\Controllers;

use App\Models\LandListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction;


class LandListingController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'landowner_name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'price' => 'required|numeric',
                'phone_number' => 'required|string|max:15',
                'size' => 'required|numeric',
                'soil_quality' => 'required|string|max:255',
                'land_condition' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('land_images', 'public');
            }
            LandListing::create([
                'landowner_name' => $request->landowner_name,
                'location' => $request->location,
                'price' => $request->price,
                'phone_number' => $request->phone_number,
                'size' => $request->size,
                'soil_quality' => $request->soil_quality,
                'land_condition' => $request->land_condition,
                'description' => $request->description,
                'image' => $imagePath ?? null,
                'landowner_id' => Auth::id(),
            ]);
            return redirect()->route('home')->with('success', 'Land listing created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'There was an error creating the land listing. Please try again.');
        }
    }
    public function index() //superadmin only
    {
        $landListings = LandListing::where('status', 'approved')
            ->whereHas('transaction', function ($query) {
                $query->whereIn('status', ['available', 'sold_out', 'reserved']);
            })
            ->with('transaction')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('users.superadmin.land_posting', compact('landListings'));
    }
    public function admin() //admin view
    {
        $landListings = LandListing::where('status', 'approved')
            ->whereHas('transaction', function ($query) {
                $query->whereIn('status', ['available', 'sold_out', 'reserved']);
            })
            ->with('transaction')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('users.admin.home', compact('landListings'));
    }
    public function newListings() //admin notification
    {
        $newListings = LandListing::where('status', 'pending')
            ->join('users', 'users.id', '=', 'land_listings.landowner_id')
            ->orderBy('land_listings.created_at', 'desc')
            ->get([
                'land_listings.id',
                'land_listings.landowner_name',
                'land_listings.location',
                'users.avatar as image',
                'land_listings.created_at'
            ]);

        $newListings->transform(function ($listing) {
            $listing->image = $listing->image
                ? asset('storage/' . $listing->image)
                : asset('images/default-placeholder.jpg');
            return $listing;
        });

        return response()->json([
            'count' => $newListings->count(),
            'listings' => $newListings
        ]);
    }



    public function show($id) //admin modal
    {
        $listing = LandListing::findOrFail($id);

        return response()->json([
            'id' => $listing->id,
            'landowner_name' => $listing->landowner_name,
            'price' => $listing->price,
            'size' => $listing->size,
            'soil_quality' => $listing->soil_quality,
            'land_condition' => $listing->land_condition,
            'location' => $listing->location,
            'description' => $listing->description,
            'image' => asset('storage/' . $listing->image),
            'created_at' => Carbon::parse($listing->created_at)->diffForHumans(),
        ]);
    }

    public function approve($id)
    {
        $listing = LandListing::findOrFail($id);
        $listing->status = 'approved';
        $listing->approved_by = Auth::id();
        $listing->save();

        $listing = LandListing::find($id);

        if (!$listing || !$listing->landowner_id) {
            Log::error("Transaction Error: Listing ID {$id} has no associated user.");
            return back()->with('error', 'Transaction failed due to missing landowner.');
        }

        $transaction = Transaction::firstOrCreate(
            ['land_listing_id' => $id],
            ['user_id' => $listing->landowner_id, 'status' => 'available']
        );
        if (!$transaction->wasRecentlyCreated) {
            $transaction->update(['status' => 'available']);
            Log::info("Transaction Updated: Listing ID {$id}, Transaction ID {$transaction->id}, Status set to 'available'.");
        } else {
            Log::info("Transaction Created: Listing ID {$id}, Transaction ID {$transaction->id}, Status set to 'available'.");
        }

        if (!$transaction) {
            Log::error("Transaction Failed: Could not create transaction for Listing ID {$id}.");
        }

        return response()->json(['message' => 'Listing approved, transaction status set to available']);
    }

    public function decline($id) //admin decline
    {
        $listing = LandListing::findOrFail($id);
        $listing->status = 'declined';
        $listing->approved_by = Auth::id();
        $listing->save();

        return response()->json(['message' => 'Listing declined']);
    }

    public function tenant()
    {
        $landListings = LandListing::where('status', 'approved')
            ->whereHas('transaction', function ($query) {
                $query->whereIn('status', ['available', 'sold_out', 'reserved']);
            })
            ->with('transaction')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('users.tenant.home', compact('landListings'));
    }


    public function lessee() //lessee only
    {
        $landListings = LandListing::where('status', 'approved')
            ->whereHas('transaction', function ($query) {
                $query->whereIn('status', ['available', 'sold_out', 'reserved']);
            })
            ->with('transaction')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('users.lessee.home', compact('landListings'));
    }
}
