<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Prompt;
use App\Models\Report;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Get admin dashboard.
     */
    public function getDashboard()
    {
        return response()->json([
            'message' => 'Admin dashboard retrieved',
            'data' => [
                'total_users' => User::count(),
                'total_prompts' => Prompt::count(),
                'total_reviews' => \App\Models\Review::count(),
                'total_copies' => Prompt::sum('copy_count'),
                'pending_prompts' => Prompt::where('status', 'pending')->count(),
                'reported_prompts' => Report::where('status', 'pending')->count(),
                'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
            ],
        ]);
    }

    /**
     * Get admin analytics.
     */
    public function getAnalytics()
    {
        return response()->json([
            'message' => 'Admin analytics retrieved',
            'data' => [
                'user_growth' => User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                    ->groupBy('date')
                    ->limit(30)
                    ->get(),
                'prompt_submissions' => Prompt::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                    ->groupBy('date')
                    ->limit(30)
                    ->get(),
            ],
        ]);
    }

    /**
     * Get all users.
     */
    public function getAllUsers()
    {
        $users = User::paginate(20);
        return response()->json(['data' => $users]);
    }

    /**
     * Update user role.
     */
    public function updateUserRole(Request $request, $userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validated = $request->validate([
            'role' => 'required|in:user,creator,admin',
        ]);

        $user->update(['role' => $validated['role']]);

        return response()->json(['message' => 'User role updated', 'data' => $user]);
    }

    /**
     * Delete user.
     */
    public function deleteUser(Request $request, $userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }

    /**
     * Get all prompts.
     */
    public function getAllPrompts()
    {
        $prompts = Prompt::with('user')->paginate(20);
        return response()->json(['data' => $prompts]);
    }

    /**
     * Approve prompt.
     */
    public function approvePrompt(Request $request, $promptId)
    {
        $prompt = Prompt::find($promptId);
        if (!$prompt) {
            return response()->json(['message' => 'Prompt not found'], 404);
        }

        $prompt->update(['status' => 'approved']);
        return response()->json(['message' => 'Prompt approved', 'data' => $prompt]);
    }

    /**
     * Reject prompt.
     */
    public function rejectPrompt(Request $request, $promptId)
    {
        $validated = $request->validate([
            'feedback' => 'required|string',
        ]);

        $prompt = Prompt::find($promptId);
        if (!$prompt) {
            return response()->json(['message' => 'Prompt not found'], 404);
        }

        $prompt->update([
            'status' => 'rejected',
        ]);

        return response()->json(['message' => 'Prompt rejected', 'data' => $prompt]);
    }

    /**
     * Delete prompt.
     */
    public function deletePrompt(Request $request, $promptId)
    {
        $prompt = Prompt::find($promptId);
        if (!$prompt) {
            return response()->json(['message' => 'Prompt not found'], 404);
        }

        $prompt->delete();
        return response()->json(['message' => 'Prompt deleted']);
    }

    /**
     * Feature prompt.
     */
    public function featurePrompt(Request $request, $promptId)
    {
        $prompt = Prompt::find($promptId);
        if (!$prompt) {
            return response()->json(['message' => 'Prompt not found'], 404);
        }

        $prompt->update([
            'is_featured' => !$prompt->is_featured,
        ]);

        return response()->json(['message' => 'Prompt featured status updated', 'data' => $prompt]);
    }

    /**
     * Get all payments.
     */
    public function getAllPayments()
    {
        $payments = Payment::with('user')->paginate(20);
        return response()->json(['data' => $payments]);
    }

    /**
     * Get all reports.
     */
    public function getAllReports()
    {
        $reports = Report::with(['user', 'prompt'])->paginate(20);
        return response()->json(['data' => $reports]);
    }

    /**
     * Resolve report.
     */
    public function resolveReport(Request $request, $reportId)
    {
        $report = Report::find($reportId);
        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        $report->update(['status' => 'resolved']);
        return response()->json(['message' => 'Report resolved', 'data' => $report]);
    }

    /**
     * Dismiss report.
     */
    public function dismissReport(Request $request, $reportId)
    {
        $report = Report::find($reportId);
        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        $report->update(['status' => 'dismissed']);
        return response()->json(['message' => 'Report dismissed', 'data' => $report]);
    }

    /**
     * Warn creator.
     */
    public function warnCreator(Request $request, $reportId)
    {
        $report = Report::with('prompt.user')->find($reportId);
        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        // TODO: Send warning email to creator
        // Mail::send(...);

        $report->update(['status' => 'resolved']);
        return response()->json(['message' => 'Creator warned', 'data' => $report]);
    }
}
