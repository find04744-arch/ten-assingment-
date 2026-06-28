<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductItemsController extends Controller
{
    public function index()
    {
        $items = ProductItem::latest()->paginate(20);

        return view('backend.pages.product_items.index', compact('items'));
    }

    public function create()
    {
        $categories = ProductItem::categories();
        $subcategoriesByCategory = collect($categories)
            ->mapWithKeys(fn ($cat) => [$cat => ProductItem::subcategories($cat)])
            ->all();

        return view('backend.pages.product_items.create', compact('categories', 'subcategoriesByCategory'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => ['required', 'string'],
            'item_type' => ['required', 'in:feature,gallery'],
            'subcategory' => ['required_if:item_type,gallery', 'nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image_path' => ['nullable', 'image', 'max:300'],
            'icon' => ['nullable', 'string', 'max:255'],
        ]);

        if (($data['item_type'] ?? null) !== 'gallery') {
            $data['subcategory'] = null;
        }

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('product_items', 'public');
        }

        ProductItem::create($data);

        return redirect()->route('admin.product-items.index')->with('success', 'Product Item added successfully');
    }

    public function edit(ProductItem $product_item)
    {
        $categories = ProductItem::categories();
        $subcategoriesByCategory = collect($categories)
            ->mapWithKeys(fn ($cat) => [$cat => ProductItem::subcategories($cat)])
            ->all();

        return view('backend.pages.product_items.edit', compact('product_item', 'categories', 'subcategoriesByCategory'));
    }

    public function update(Request $request, ProductItem $product_item)
    {
        $data = $request->validate([
            'category' => ['required', 'string'],
            'item_type' => ['required', 'in:feature,gallery'],
            'subcategory' => ['required_if:item_type,gallery', 'nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image_path' => ['nullable', 'image', 'max:300'],
            'icon' => ['nullable', 'string', 'max:255'],
        ]);

        if (($data['item_type'] ?? null) !== 'gallery') {
            $data['subcategory'] = null;
        }

        if ($request->hasFile('image_path')) {
            if ($product_item->image_path) {
                Storage::disk('public')->delete($product_item->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('product_items', 'public');
        }

        $product_item->update($data);

        return redirect()->route('admin.product-items.index')->with('success', 'Product Item updated successfully');
    }

    public function destroy(ProductItem $product_item)
    {
        if ($product_item->image_path) {
            Storage::disk('public')->delete($product_item->image_path);
        }
        $product_item->delete();

        return redirect()->route('admin.product-items.index')->with('success', 'Product Item deleted successfully');
    }
}
