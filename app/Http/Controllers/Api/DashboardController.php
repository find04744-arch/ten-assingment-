<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prompt;
use App\Models\Review;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Get user dashboard stats.
     */
    public function getUserStats(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'message' => 'User stats retrieved',
            'data' => [
                'total_prompts' => $user->prompts()->count(),
                'total_bookmarks' => $user->bookmarks()->count(),
                'total_reviews' => $user->reviews()->count(),
                'subscription_status' => $user->subscription_status,
                'subscription_expires_at' => $user->subscription_expires_at,
            ],
        ]);
    }

    /**
     * Get user analytics.
     */
    public function getUserAnalytics(Request $request)
    {
        $user = $request->user();

        $analytics = [
            'total_copies' => Prompt::where('user_id', $user->id)->sum('copy_count'),
            'total_bookmarks' => Bookmark::whereHas('prompt', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->count(),
            'average_rating' => Review::whereHas('prompt', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->avg('rating') ?? 0,
        ];

        return response()->json([
            'message' => 'Analytics retrieved',
            'data' => $analytics,
        ]);
    }

    /**
     * Get creator dashboard.
     */
    public function getCreatorDashboard(Request $request)
    {
        $user = $request->user();
        $prompts = Prompt::where('user_id', $user->id)
            ->withCount('reviews', 'bookmarks')
            ->get();

        return response()->json([
            'message' => 'Creator dashboard retrieved',
            'data' => [
                'total_prompts' => $prompts->count(),
                'total_copies' => $prompts->sum('copy_count'),
                'total_bookmarks' => $prompts->sum('bookmarks_count'),
                'total_reviews' => $prompts->sum('reviews_count'),
                'prompts' => $prompts,
            ],
        ]);
    }

    /**
     * Get creator analytics.
     */
    public function getCreatorAnalytics(Request $request)
    {
        $user = $request->user();

        $prompts = Prompt::where('user_id', $user->id)->get();

        $copyGrowth = $prompts->map(function ($prompt) {
            return [
                'prompt_id' => $prompt->id,
                'title' => $prompt->title,
                'copies' => $prompt->copy_count,
            ];
        });

        return response()->json([
            'message' => 'Creator analytics retrieved',
            'data' => [
                'copy_growth' => $copyGrowth,
                'prompt_growth' => $prompts->count(),
            ],
        ]);
    }
}
