<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CareerApplication;
use App\Models\CareerPost;
use Illuminate\Http\Request;

class CareerPostsController extends Controller
{
    public function index()
    {
        $items = CareerPost::latest()->paginate(20);
        $applications = CareerApplication::latest()->paginate(10);

        return view('backend.pages.careers.index', compact('items', 'applications'));
    }

    public function destroyApplication(CareerApplication $application)
    {
        if ($application->resume_path) {
            \Storage::disk('public')->delete($application->resume_path);
        }
        $application->delete();

        return redirect()->route('admin.careers.index')->with('success', 'Career application deleted successfully.');
    }

    public function create()
    {
        return view('backend.pages.careers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'experience' => ['nullable', 'string', 'max:255'],
            'salary' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'deadline' => ['nullable', 'date'],
            'is_active' => ['required', 'boolean'],
        ]);
        CareerPost::create($data);

        return redirect()->route('admin.careers.index')->with('success', 'Career post created successfully.');
    }

    public function edit(CareerPost $career)
    {
        return view('backend.pages.careers.edit', compact('career'));
    }

    public function update(Request $request, CareerPost $career)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'experience' => ['nullable', 'string', 'max:255'],
            'salary' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'deadline' => ['nullable', 'date'],
            'is_active' => ['required', 'boolean'],
        ]);
        $career->update($data);

        return redirect()->route('admin.careers.index')->with('success', 'Career post updated successfully.');
    }

    public function destroy(CareerPost $career)
    {
        $career->delete();

        return redirect()->route('admin.careers.index')->with('success', 'Career post deleted successfully.');
    }
}
