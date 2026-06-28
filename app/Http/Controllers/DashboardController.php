<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prompt;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $promptsCount = $user->prompts()->count();
        $reviews = $user->reviews()->count();
        $bookmarks = $user->bookmarks()->count();
        $totalCopies = $user->prompts()->sum('copy_count');

        return view('dashboard.index', compact('user', 'promptsCount', 'reviews', 'bookmarks', 'totalCopies'));
    }

    public function profile()
    {
        return view('dashboard.profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'photo_url' => 'nullable|url',
        ]);

        Auth::user()->update($validated);

        return back()->with('status', 'Profile updated successfully!');
    }

    public function savedPrompts()
    {
        $bookmarks = Auth::user()->bookmarks()->with('prompt')->paginate(12);
        return view('dashboard.saved-prompts', compact('bookmarks'));
    }

    public function myReviews()
    {
        $reviews = Auth::user()->reviews()->with('prompt')->paginate(12);
        return view('dashboard.my-reviews', compact('reviews'));
    }

    public function payment()
    {
        $user = Auth::user();
        return view('dashboard.payment', compact('user'));
    }

    public function createCheckout(Request $request)
    {
        // Stripe integration
        return view('dashboard.checkout');
    }

    public function paymentSuccess()
    {
        Auth::user()->update([
            'subscription_status' => 'premium',
            'subscription_expires_at' => now()->addYear(),
        ]);

        return redirect(route('dashboard'))->with('status', 'Payment successful! You are now a premium user!');
    }

    public function paymentCancel()
    {
        return redirect(route('payment'))->with('error', 'Payment was cancelled.');
    }

    public function creatorDashboard()
    {
        if (Auth::user()->role !== 'creator' && Auth::user()->role !== 'admin') {
            abort(403, 'Only creators can access this dashboard.');
        }
        $user = Auth::user();

        $stats = [
            'total_prompts' => $user->prompts()->count(),
            'total_copies' => $user->prompts()->sum('copy_count'),
            'total_reviews' => $user->prompts()->with('reviews')->get()->sum(fn($p) => $p->reviews->count()),
            'avg_rating' => $user->prompts()->with('reviews')->get()->average(fn($p) => $p->averageRating()),
            'total_bookmarks' => $user->prompts()->with('bookmarks')->get()->sum(fn($p) => $p->bookmarks->count()),
        ];

        return view('dashboard.creator-dashboard', compact('stats'));
    }

    public function creatorAnalytics()
    {
        if (Auth::user()->role !== 'creator' && Auth::user()->role !== 'admin') {
            abort(403, 'Only creators can access analytics.');
        }

        $prompts = Auth::user()->prompts()->with('reviews', 'bookmarks')->get();

        $analyticsData = $prompts->map(function ($prompt) {
            return [
                'title' => $prompt->title,
                'copies' => $prompt->copy_count,
                'reviews' => $prompt->reviews()->count(),
                'rating' => $prompt->averageRating(),
                'bookmarks' => $prompt->bookmarks()->count(),
            ];
        });

        return view('dashboard.creator-analytics', compact('analyticsData'));
    }
}
