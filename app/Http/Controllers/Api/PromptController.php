<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prompt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromptController extends Controller
{
    /**
     * Get all public prompts with filtering and sorting.
     */
    public function getAllPublicPrompts(Request $request)
    {
        $query = Prompt::with('user')->where('visibility', 'public')->where('status', 'approved');

        // Search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereJsonContains('tags', $search);
            });
        }

        // Filter by category
        if ($request->has('category')) {
            $query->where('category', $request->input('category'));
        }

        // Filter by AI tool
        if ($request->has('ai_tool')) {
            $query->where('ai_tool', $request->input('ai_tool'));
        }

        // Filter by difficulty
        if ($request->has('difficulty')) {
            $query->where('difficulty_level', $request->input('difficulty'));
        }

        // Sorting
        $sort = $request->input('sort', 'latest');
        switch ($sort) {
            case 'popular':
                $query->withAvg('reviews', 'rating')
                    ->orderByDesc('reviews_avg_rating');
                break;
            case 'most_copied':
                $query->orderByDesc('copy_count');
                break;
            case 'latest':
            default:
                $query->orderByDesc('created_at');
        }

        $prompts = $query->paginate(12);

        return response()->json([
            'message' => 'Prompts retrieved successfully',
            'data' => $prompts,
        ]);
    }

    /**
     * Get featured prompts.
     */
    public function getFeaturedPrompts()
    {
        $prompts = Prompt::with('user')
            ->where('visibility', 'public')
            ->where('status', 'approved')
            ->where('is_featured', true)
            ->limit(6)
            ->get();

        return response()->json([
            'message' => 'Featured prompts retrieved',
            'data' => $prompts,
        ]);
    }

    /**
     * Get trending prompts.
     */
    public function getTrendingPrompts()
    {
        $prompts = Prompt::with('user')
            ->where('visibility', 'public')
            ->where('status', 'approved')
            ->withCount('reviews', 'bookmarks')
            ->orderByDesc('copy_count')
            ->limit(10)
            ->get();

        return response()->json([
            'message' => 'Trending prompts retrieved',
            'data' => $prompts,
        ]);
    }

    /**
     * Get top creators.
     */
    public function getTopCreators()
    {
        $creators = User::withCount('prompts')
            ->where('role', 'creator')
            ->orderByDesc('total_copies')
            ->limit(5)
            ->get();

        return response()->json([
            'message' => 'Top creators retrieved',
            'data' => $creators,
        ]);
    }

    /**
     * Get single prompt.
     */
    public function show($id)
    {
        $prompt = Prompt::with(['user', 'reviews.user'])->find($id);

        if (!$prompt) {
            return response()->json(['message' => 'Prompt not found'], 404);
        }

        // If private and not owned by user
        if ($prompt->visibility === 'private' && auth('sanctum')->user()?->id !== $prompt->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json([
            'message' => 'Prompt retrieved successfully',
            'data' => $prompt,
        ]);
    }

    /**
     * Store a new prompt.
     */
    public function store(Request $request)
    {
        $user = $request->user();

        // Check if user can add more prompts
        if (!$user->canAddPrompt()) {
            return response()->json([
                'message' => 'You have reached your prompt limit. Upgrade to Premium for unlimited prompts.',
            ], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'category' => 'required|string',
            'ai_tool' => 'required|string',
            'tags' => 'nullable|array',
            'difficulty_level' => 'required|in:beginner,intermediate,pro',
            'thumbnail_image' => 'nullable|image|max:2048',
            'visibility' => 'required|in:public,private',
        ]);

        $prompt = new Prompt($validated);
        $prompt->user_id = $user->id;
        $prompt->status = 'pending';
        $prompt->copy_count = 0;

        if ($request->hasFile('thumbnail_image')) {
            $path = $request->file('thumbnail_image')->store('prompts', 'public');
            $prompt->thumbnail_image = $path;
        }

        $prompt->save();

        return response()->json([
            'message' => 'Prompt created successfully and pending approval',
            'data' => $prompt,
        ], 201);
    }

    /**
     * Update a prompt.
     */
    public function update(Request $request, $id)
    {
        $prompt = Prompt::find($id);

        if (!$prompt) {
            return response()->json(['message' => 'Prompt not found'], 404);
        }

        if ($prompt->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'content' => 'string',
            'category' => 'string',
            'ai_tool' => 'string',
            'tags' => 'nullable|array',
            'difficulty_level' => 'in:beginner,intermediate,pro',
            'visibility' => 'in:public,private',
        ]);

        $prompt->update($validated);

        return response()->json([
            'message' => 'Prompt updated successfully',
            'data' => $prompt,
        ]);
    }

    /**
     * Delete a prompt.
     */
    public function destroy(Request $request, $id)
    {
        $prompt = Prompt::find($id);

        if (!$prompt) {
            return response()->json(['message' => 'Prompt not found'], 404);
        }

        if ($prompt->user_id !== $request->user()->id && !$request->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $prompt->delete();

        return response()->json([
            'message' => 'Prompt deleted successfully',
        ]);
    }

    /**
     * Get user prompts.
     */
    public function getUserPrompts(Request $request)
    {
        $prompts = Prompt::where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate(12);

        return response()->json([
            'message' => 'User prompts retrieved',
            'data' => $prompts,
        ]);
    }

    /**
     * Get creator prompts.
     */
    public function getCreatorPrompts(Request $request)
    {
        $prompts = Prompt::where('user_id', $request->user()->id)
            ->withCount('reviews', 'bookmarks')
            ->orderByDesc('created_at')
            ->paginate(15);

        return response()->json([
            'message' => 'Creator prompts retrieved',
            'data' => $prompts,
        ]);
    }

    /**
     * Increment copy count.
     */
    public function incrementCopyCount($id)
    {
        $prompt = Prompt::find($id);

        if (!$prompt) {
            return response()->json(['message' => 'Prompt not found'], 404);
        }

        $prompt->increment('copy_count');

        return response()->json([
            'message' => 'Copy count incremented',
            'copy_count' => $prompt->copy_count,
        ]);
    }

    /**
     * Store creator prompt.
     */
    public function storeCreatorPrompt(Request $request)
    {
        return $this->store($request);
    }

    /**
     * Update creator prompt.
     */
    public function updateCreatorPrompt(Request $request, $id)
    {
        return $this->update($request, $id);
    }

    /**
     * Delete creator prompt.
     */
    public function destroyCreatorPrompt(Request $request, $id)
    {
        return $this->destroy($request, $id);
    }
}
