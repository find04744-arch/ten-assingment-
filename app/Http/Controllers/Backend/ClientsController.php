<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientsController extends Controller
{
    public function index()
    {
        $items = Client::latest()->paginate(20);

        return view('backend.pages.clients.index', compact('items'));
    }

    public function create()
    {
        return view('backend.pages.clients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'logo_path' => ['required', 'image', 'max:300'], // Max 300KB
            'website_url' => ['nullable', 'date'],
        ]);

        // Provide a default name since it's required in DB but removed from form
        $data['name'] = 'Client';

        $data['status'] = true; // Default to active

        if ($request->hasFile('logo_path')) {
            $path = $request->file('logo_path')->store('clients', 'public');
            $data['logo_path'] = $path;
        }

        Client::create($data);

        return redirect()->route('admin.clients.index')->with('success', 'Client added successfully');
    }

    public function edit(Client $client)
    {
        return view('backend.pages.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'logo_path' => ['nullable', 'image', 'max:300'], // Max 300KB
            'website_url' => ['nullable', 'date'],
        ]);

        // Status remains unchanged or defaults to true if not present (logic handled by DB default usually, but here we just ignore updating it from form or keep it as is)
        // Actually, if we remove it from form, we should probably just not update it, or keep it as is.
        // But since we are removing the field, we don't need to validate it.
        // Let's just not update 'status' from the form.

        if ($request->hasFile('logo_path')) {
            // Delete old image if exists
            if ($client->logo_path && Storage::disk('public')->exists($client->logo_path)) {
                Storage::disk('public')->delete($client->logo_path);
            }
            $path = $request->file('logo_path')->store('clients', 'public');
            $data['logo_path'] = $path;
        } else {
            unset($data['logo_path']); // Keep existing if not uploaded
        }

        $client->update($data);

        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully');
    }

    public function destroy(Client $client)
    {
        if ($client->logo_path && Storage::disk('public')->exists($client->logo_path)) {
            Storage::disk('public')->delete($client->logo_path);
        }
        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully');
    }
}
