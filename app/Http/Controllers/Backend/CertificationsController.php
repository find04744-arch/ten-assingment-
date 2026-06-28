<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificationsController extends Controller
{
    public function index()
    {
        $items = Certification::latest()->paginate(20);

        return view('backend.pages.certifications.index', compact('items'));
    }

    public function create()
    {
        return view('backend.pages.certifications.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image_path' => ['nullable', 'image', 'max:300'],
            'issued_at' => ['nullable', 'date'],
        ]);

        // Provide a safe default title for non-nullable DB column
        $data['title'] = 'Certification';
        // Description not used in UI; keep null
        $data['description'] = $request->input('description') ?? null;
        // Issued By removed from form
        $data['issued_by'] = null;

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('certifications', 'public');
        }

        Certification::create($data);

        return redirect()->route('admin.certifications.index')->with('success', 'Certification added successfully');
    }

    public function edit(Certification $certification)
    {
        return view('backend.pages.certifications.edit', compact('certification'));
    }

    public function update(Request $request, Certification $certification)
    {
        $data = $request->validate([
            'image_path' => ['nullable', 'image', 'max:300'],
            'issued_at' => ['nullable', 'date'],
        ]);

        if ($request->hasFile('image_path')) {
            if ($certification->image_path) {
                Storage::disk('public')->delete($certification->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('certifications', 'public');
        }

        $certification->update($data);

        return redirect()->route('admin.certifications.index')->with('success', 'Certification updated successfully');
    }

    public function destroy(Certification $certification)
    {
        if ($certification->image_path) {
            Storage::disk('public')->delete($certification->image_path);
        }
        $certification->delete();

        return redirect()->route('admin.certifications.index')->with('success', 'Certification deleted successfully');
    }
}
