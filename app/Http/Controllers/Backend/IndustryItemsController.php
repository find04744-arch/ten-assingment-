<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\IndustryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndustryItemsController extends Controller
{
    public function index()
    {
        $items = IndustryItem::latest()->paginate(20);

        return view('backend.pages.industry_items.index', compact('items'));
    }

    public function create()
    {
        $categories = IndustryItem::categories();

        return view('backend.pages.industry_items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => ['required', 'string'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image_path' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('industry_items', 'public');
        }

        IndustryItem::create($data);

        return redirect()->route('admin.industry-items.index')->with('success', 'Industry Item added successfully');
    }

    public function edit(IndustryItem $industry_item)
    {
        $categories = IndustryItem::categories();

        return view('backend.pages.industry_items.edit', compact('industry_item', 'categories'));
    }

    public function update(Request $request, IndustryItem $industry_item)
    {
        $data = $request->validate([
            'category' => ['required', 'string'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image_path' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image_path')) {
            if ($industry_item->image_path) {
                Storage::disk('public')->delete($industry_item->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('industry_items', 'public');
        }

        $industry_item->update($data);

        return redirect()->route('admin.industry-items.index')->with('success', 'Industry Item updated successfully');
    }

    public function destroy(IndustryItem $industry_item)
    {
        if ($industry_item->image_path) {
            Storage::disk('public')->delete($industry_item->image_path);
        }
        $industry_item->delete();

        return redirect()->route('admin.industry-items.index')->with('success', 'Industry Item deleted successfully');
    }
}
