<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'landlisting_id' => 'required|exists:land_listings,id',
                'comments' => 'required|string',
                'rating' => 'required|integer|min:1|max:5',
            ]);

            Comment::create([
                'user_id' => Auth::id(),
                'landlisting_id' => $request->landlisting_id,
                'comments' => $request->comments,
                'rating' => $request->rating,
            ]);

            return response()->json(['success' => true, 'message' => 'Comment added successfully!']);
        } catch (\Exception $e) {
            Log::error('Error adding comment: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'request' => $request->all()
            ]);

            return response()->json(['success' => false, 'message' => 'Something went wrong!'], 500);
        }
    }
}
