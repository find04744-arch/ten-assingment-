<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Store a new report.
     */
    public function store(Request $request, $promptId)
    {
        $validated = $request->validate([
            'reason' => 'required|array',
            'description' => 'nullable|string',
        ]);

        $report = Report::create([
            'user_id' => $request->user()->id,
            'prompt_id' => $promptId,
            'reason' => $validated['reason'],
            'description' => $validated['description'] ?? null,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Report submitted successfully',
            'data' => $report,
        ], 201);
    }
}
