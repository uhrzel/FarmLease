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

            // Handle file upload if present
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('land_images', 'public');
            }

            // Create the land listing
            LandListing::create([
                'landowner_name' => $request->landowner_name,
                'location' => $request->location,
                'price' => $request->price,
                'phone_number' => $request->phone_number,
                'size' => $request->size,
                'soil_quality' => $request->soil_quality,
                'land_condition' => $request->land_condition,
                'description' => $request->description,
                'image' => $imagePath ?? null, // Store image path if uploaded
                'landowner_id' => Auth::id(),  // Store the ID of the authenticated user
            ]);

            // Redirect or respond as needed
            return redirect()->route('home')->with('success', 'Land listing created successfully!');
        } catch (\Exception $e) {
            // Handle error and redirect with error message
            return redirect()->route('home')->with('error', 'There was an error creating the land listing. Please try again.');
        }
    }
}
