<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{
    /**
     * Get prompt reviews.
     */
    public function getPromptReviews($promptId)
    {
        $reviews = Review::with('user')
            ->where('prompt_id', $promptId)
            ->orderByDesc('created_at')
            ->paginate(10);

        return response()->json([
            'message' => 'Reviews retrieved',
            'data' => $reviews,
        ]);
    }

    /**
     * Get user reviews.
     */
    public function getUserReviews(Request $request)
    {
        $reviews = Review::with('prompt')
            ->where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate(12);

        return response()->json([
            'message' => 'User reviews retrieved',
            'data' => $reviews,
        ]);
    }

    /**
     * Get single review.
     */
    public function show($id)
    {
        $review = Review::with(['user', 'prompt'])->find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        return response()->json([
            'message' => 'Review retrieved',
            'data' => $review,
        ]);
    }

    /**
     * Store a new review.
     */
    public function store(Request $request, $promptId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        // Check if user already reviewed
        $existing = Review::where('user_id', $request->user()->id)
            ->where('prompt_id', $promptId)
            ->first();

        if ($existing) {
            throw ValidationException::withMessages([
                'review' => 'You have already reviewed this prompt',
            ]);
        }

        $review = Review::create([
            'prompt_id' => $promptId,
            'user_id' => $request->user()->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return response()->json([
            'message' => 'Review submitted successfully',
            'data' => $review->load('user'),
        ], 201);
    }

    /**
     * Update a review.
     */
    public function update(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        if ($review->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'rating' => 'integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $review->update($validated);

        return response()->json([
            'message' => 'Review updated',
            'data' => $review,
        ]);
    }

    /**
     * Delete a review.
     */
    public function destroy(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        if ($review->user_id !== $request->user()->id && !$request->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $review->delete();

        return response()->json([
            'message' => 'Review deleted',
        ]);
    }
}
