<?php

namespace App\Http\Controllers;

use App\Models\Prompt;
use App\Models\Review;
use App\Models\Bookmark;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromptController extends Controller
{
    public function index()
    {
        $featured = Prompt::where('is_featured', true)
            ->where('visibility', 'public')
            ->where('status', 'approved')
            ->with('user')
            ->latest()
            ->take(6)
            ->get();

        return view('prompts.index', compact('featured'));
    }

    public function allPrompts(Request $request)
    {
        $query = Prompt::where('visibility', 'public')
            ->where('status', 'approved')
            ->with('user', 'reviews');

        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                    ->orWhere('description', 'like', "%{$request->search}%")
                    ->orWhere('tags', 'like', "%{$request->search}%");
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Filter by difficulty
        if ($request->has('difficulty') && $request->difficulty) {
            $query->where('difficulty_level', $request->difficulty);
        }

        // Sort
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'popular':
                $query->orderBy('copy_count', 'desc');
                break;
            case 'rating':
                $query->withAvg('reviews', 'rating')
                    ->orderByDesc('reviews_avg_rating');
                break;
            case 'copies':
                $query->orderBy('copy_count', 'desc');
                break;
            default:
                $query->latest();
        }

        $prompts = $query->paginate(12);

        return view('prompts.all', compact('prompts'));
    }

    public function show(Prompt $prompt)
    {
        if ($prompt->visibility === 'private' && $prompt->user_id !== Auth::id()) {
            abort(403);
        }

        if ($prompt->status !== 'approved' && $prompt->user_id !== Auth::id() && !Auth::user()?->isAdmin()) {
            abort(403);
        }

        $reviews = $prompt->reviews()->with('user')->paginate(10);
        $isBookmarked = Auth::check() && $prompt->bookmarks()->where('user_id', Auth::id())->exists();

        return view('prompts.show', compact('prompt', 'reviews', 'isBookmarked'));
    }

    public function create()
    {
        $this->authorize('create', Prompt::class);
        return view('prompts.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Prompt::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string',
            'ai_tool' => 'required|string',
            'difficulty_level' => 'required|in:beginner,intermediate,pro',
            'tags' => 'nullable|string',
            'thumbnail_image' => 'nullable|image|max:2048',
            'visibility' => 'required|in:public,private',
        ]);

        if ($request->hasFile('thumbnail_image')) {
            $validated['thumbnail_image'] = $request->file('thumbnail_image')->store('prompts', 'public');
        }

        $validated['user_id'] = Auth::id();
        $validated['tags'] = explode(',', $validated['tags'] ?? '');
        $validated['status'] = 'pending';

        Prompt::create($validated);

        return redirect(route('my-prompts'))->with('status', 'Prompt created successfully!');
    }

    public function edit(Prompt $prompt)
    {
        $this->authorize('update', $prompt);
        return view('prompts.edit', compact('prompt'));
    }

    public function update(Request $request, Prompt $prompt)
    {
        $this->authorize('update', $prompt);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string',
            'ai_tool' => 'required|string',
            'difficulty_level' => 'required|in:beginner,intermediate,pro',
            'tags' => 'nullable|string',
            'visibility' => 'required|in:public,private',
        ]);

        $validated['tags'] = explode(',', $validated['tags'] ?? '');
        $prompt->update($validated);

        return redirect(route('my-prompts'))->with('status', 'Prompt updated successfully!');
    }

    public function destroy(Prompt $prompt)
    {
        $this->authorize('delete', $prompt);
        $prompt->delete();

        return redirect(route('my-prompts'))->with('status', 'Prompt deleted successfully!');
    }

    public function myPrompts()
    {
        $prompts = Auth::user()->prompts()->latest()->paginate(12);
        return view('prompts.my-prompts', compact('prompts'));
    }

    public function toggleBookmark(Prompt $prompt)
    {
        $exists = Bookmark::where('user_id', Auth::id())
            ->where('prompt_id', $prompt->id)
            ->exists();

        if ($exists) {
            Bookmark::where('user_id', Auth::id())
                ->where('prompt_id', $prompt->id)
                ->delete();
            $bookmarked = false;
        } else {
            Bookmark::create([
                'user_id' => Auth::id(),
                'prompt_id' => $prompt->id,
            ]);
            $bookmarked = true;
        }

        if (request()->wantsJson()) {
            return response()->json(['bookmarked' => $bookmarked]);
        }

        return back()->with('status', $bookmarked ? 'Added to bookmarks!' : 'Removed from bookmarks!');
    }

    public function storeReview(Request $request, Prompt $prompt)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:500',
        ]);

        // Check if user already reviewed
        $existing = Review::where('user_id', Auth::id())
            ->where('prompt_id', $prompt->id)
            ->exists();

        if ($existing) {
            return back()->withErrors(['review' => 'You have already reviewed this prompt.']);
        }

        Review::create([
            'user_id' => Auth::id(),
            'prompt_id' => $prompt->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return back()->with('status', 'Review submitted successfully!');
    }

    public function destroyReview(Review $review)
    {
        $this->authorize('delete', $review);
        $promptId = $review->prompt_id;
        $review->delete();

        return back()->with('status', 'Review deleted successfully!');
    }

    public function report(Request $request, Prompt $prompt)
    {
        $validated = $request->validate([
            'reason' => 'required|array',
            'description' => 'nullable|string|max:500',
        ]);

        Report::create([
            'user_id' => Auth::id(),
            'prompt_id' => $prompt->id,
            'reason' => $validated['reason'],
            'description' => $validated['description'],
            'status' => 'pending',
        ]);

        return back()->with('status', 'Report submitted successfully!');
    }
}
