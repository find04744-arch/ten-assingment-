<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Prompt;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * Get user bookmarks.
     */
    public function getUserBookmarks(Request $request)
    {
        $bookmarks = Bookmark::with('prompt.user')
            ->where('user_id', $request->user()->id)
            ->paginate(12);

        return response()->json([
            'message' => 'Bookmarks retrieved',
            'data' => $bookmarks->pluck('prompt'),
        ]);
    }

    /**
     * Toggle bookmark status.
     */
    public function toggleBookmark(Request $request, $promptId)
    {
        $user = $request->user();

        $bookmark = Bookmark::where('user_id', $user->id)
            ->where('prompt_id', $promptId)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            return response()->json([
                'message' => 'Bookmark removed',
                'bookmarked' => false,
            ]);
        } else {
            Bookmark::create([
                'user_id' => $user->id,
                'prompt_id' => $promptId,
            ]);

            return response()->json([
                'message' => 'Prompt bookmarked',
                'bookmarked' => true,
            ], 201);
        }
    }
}
