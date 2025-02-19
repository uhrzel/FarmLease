<?php

namespace App\Http\Controllers;

use App\Models\LandListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $landListings = LandListing::where('status', 'approved')->orderBy('created_at', 'desc')->get();
        return view('users.superadmin.land_posting', compact('landListings'));
    }
    public function admin() //admin view
    {
        $landListings = LandListing::where('status', 'approved')->orderBy('created_at', 'desc')->get();
        return view('users.admin.home', compact('landListings'));
    }
}
