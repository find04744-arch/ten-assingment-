<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PromptController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\BookmarkController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\UserController;

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

// Authentication routes (public)
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('google', [AuthController::class, 'googleLogin']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('refresh-token', [AuthController::class, 'refreshToken'])->middleware('auth:sanctum');
});

// Public routes
Route::prefix('prompts')->group(function () {
    Route::get('/', [PromptController::class, 'getAllPublicPrompts']);
    Route::get('/featured', [PromptController::class, 'getFeaturedPrompts']);
    Route::get('/trending', [PromptController::class, 'getTrendingPrompts']);
    Route::get('/top-creators', [PromptController::class, 'getTopCreators']);
    Route::get('/{id}', [PromptController::class, 'show']);
    Route::get('/{id}/reviews', [ReviewController::class, 'getPromptReviews']);
});

// Protected routes - require authentication
Route::middleware('auth:sanctum')->group(function () {
    // User routes
    Route::prefix('user')->group(function () {
        Route::get('profile', [UserController::class, 'getProfile']);
        Route::put('profile', [UserController::class, 'updateProfile']);
        Route::get('bookmarks', [BookmarkController::class, 'getUserBookmarks']);
        Route::get('reviews', [ReviewController::class, 'getUserReviews']);
        Route::get('dashboard-stats', [DashboardController::class, 'getUserStats']);
    });

    // Prompt routes (authenticated users)
    Route::prefix('prompts')->group(function () {
        Route::post('/', [PromptController::class, 'store']);
        Route::get('/my-prompts', [PromptController::class, 'getUserPrompts']);
        Route::put('/{id}', [PromptController::class, 'update']);
        Route::delete('/{id}', [PromptController::class, 'destroy']);
        Route::post('/{id}/copy', [PromptController::class, 'incrementCopyCount']);
        Route::post('/{id}/bookmark', [BookmarkController::class, 'toggleBookmark']);
        Route::post('/{id}/review', [ReviewController::class, 'store']);
        Route::post('/{id}/report', [ReportController::class, 'store']);
    });

    // Review routes
    Route::prefix('reviews')->group(function () {
        Route::get('/{id}', [ReviewController::class, 'show']);
        Route::put('/{id}', [ReviewController::class, 'update']);
        Route::delete('/{id}', [ReviewController::class, 'destroy']);
    });

    // Payment routes
    Route::prefix('payments')->group(function () {
        Route::post('create-checkout', [PaymentController::class, 'createCheckout']);
        Route::get('success', [PaymentController::class, 'paymentSuccess']);
        Route::get('cancel', [PaymentController::class, 'paymentCancel']);
        Route::get('history', [PaymentController::class, 'paymentHistory']);
    });

    // Dashboard routes
    Route::prefix('dashboard')->group(function () {
        Route::get('stats', [DashboardController::class, 'getUserStats']);
        Route::get('analytics', [DashboardController::class, 'getUserAnalytics']);
    });
});

// Creator routes
Route::middleware(['auth:sanctum'])->prefix('creator')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'getCreatorDashboard']);
    Route::get('analytics', [DashboardController::class, 'getCreatorAnalytics']);
    Route::get('prompts', [PromptController::class, 'getCreatorPrompts']);
    Route::post('prompts', [PromptController::class, 'storeCreatorPrompt']);
    Route::put('prompts/{id}', [PromptController::class, 'updateCreatorPrompt']);
    Route::delete('prompts/{id}', [PromptController::class, 'destroyCreatorPrompt']);
});

// Admin routes
Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'getDashboard']);
    Route::get('analytics', [AdminController::class, 'getAnalytics']);

    // User management
    Route::prefix('users')->group(function () {
        Route::get('/', [AdminController::class, 'getAllUsers']);
        Route::put('{id}/role', [AdminController::class, 'updateUserRole']);
        Route::delete('{id}', [AdminController::class, 'deleteUser']);
    });

    // Prompt moderation
    Route::prefix('prompts')->group(function () {
        Route::get('/', [AdminController::class, 'getAllPrompts']);
        Route::put('{id}/approve', [AdminController::class, 'approvePrompt']);
        Route::put('{id}/reject', [AdminController::class, 'rejectPrompt']);
        Route::delete('{id}', [AdminController::class, 'deletePrompt']);
        Route::put('{id}/feature', [AdminController::class, 'featurePrompt']);
    });

    // Payment management
    Route::prefix('payments')->group(function () {
        Route::get('/', [AdminController::class, 'getAllPayments']);
    });

    // Report management
    Route::prefix('reports')->group(function () {
        Route::get('/', [AdminController::class, 'getAllReports']);
        Route::put('{id}/resolve', [AdminController::class, 'resolveReport']);
        Route::put('{id}/dismiss', [AdminController::class, 'dismissReport']);
        Route::post('{id}/warn-creator', [AdminController::class, 'warnCreator']);
    });
});

// Fallback
Route::fallback(function () {
    return response()->json([
        'message' => 'Route not found',
    ], 404);
});
