<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function edit()
    {
        $info = ContactInfo::first();
        $messages = ContactMessage::latest()->get();

        return view('backend.pages.contact_info.edit', compact('info', 'messages'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'map_embed' => ['nullable', 'string'],
            'form_title' => ['nullable', 'string', 'max:255'],
            'form_description' => ['nullable', 'string'],
            'twitter_url' => ['nullable', 'string', 'max:255'],
            'facebook_url' => ['nullable', 'string', 'max:255'],
            'contact_section_title' => ['nullable', 'string', 'max:255'],
            'contact_section_heading' => ['nullable', 'string', 'max:255'],
            'contact_section_description' => ['nullable', 'string'],
            'head_office_title' => ['nullable', 'string', 'max:255'],
            'branch_office_title' => ['nullable', 'string', 'max:255'],
            'branch_office_address' => ['nullable', 'string'],
            'branch_office_phone' => ['nullable', 'string', 'max:255'],
            'branch_office_email' => ['nullable', 'string', 'max:255'],
        ]);

        ContactInfo::updateOrCreate([], $data);

        // Flash success message
        session()->flash('success', 'Contact information updated successfully.');

        return redirect()->route('admin.contact-info.edit');
    }
}
