<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    public function edit()
    {
        $aboutUs = AboutUs::first();

        return view('backend.pages.about_us.edit', compact('aboutUs'));
    }

    public function update(Request $request)
    {
        // Validation
        $data = $request->validate([
            'intro_image_path' => ['nullable', 'image', 'max:300'],
            'experience_years' => ['required', 'string'],
            'experience_title' => ['required', 'string'],
            'intro_subtitle' => ['required', 'string'],
            'intro_title' => ['required', 'string'],
            'intro_description_1' => ['nullable', 'string'],
            'intro_description_2' => ['nullable', 'string'],
            'intro_features' => ['nullable', 'array'],
            'intro_features.*' => ['nullable', 'string'],

            'mission_title' => ['required', 'string'],
            'mission_description' => ['nullable', 'string'],
            'vision_title' => ['required', 'string'],
            'vision_description' => ['nullable', 'string'],
            'values_title' => ['required', 'string'],
            'values_description' => ['nullable', 'string'],
            'values_list' => ['nullable', 'array'],
            'values_list.*' => ['nullable', 'string'],

            'team_members' => ['nullable', 'array'],
            'team_members.*.name' => ['nullable', 'string', 'max:255'],
            'team_members.*.role' => ['nullable', 'string', 'max:255'],
            'team_members.*.facebook' => ['nullable', 'url', 'max:255'],
            'team_members.*.twitter' => ['nullable', 'url', 'max:255'],
            'team_members.*.linkedin' => ['nullable', 'url', 'max:255'],
            'team_members.*.image' => ['nullable', 'image', 'max:300'],

            'cta_title' => ['required', 'string'],
            'cta_description' => ['nullable', 'string'],
            'cta_button_text' => ['nullable', 'string'],
            'cta_button_link' => ['nullable', 'string'],
        ]);

        $aboutUs = AboutUs::first();

        // Handle Image
        if ($request->hasFile('intro_image_path')) {
            if ($aboutUs && $aboutUs->intro_image_path) {
                Storage::disk('public')->delete($aboutUs->intro_image_path);
            }
            $data['intro_image_path'] = $request->file('intro_image_path')->store('about_us', 'public');
        }

        // Filter out empty features/values if necessary, or let them be null
        if (isset($data['intro_features'])) {
            $data['intro_features'] = array_values(array_filter($data['intro_features'], fn($value) => ! is_null($value) && $value !== ''));
        }

        if (isset($data['values_list'])) {
            $data['values_list'] = array_values(array_filter($data['values_list'], fn($value) => ! is_null($value) && $value !== ''));
        }

        // Process Team Members uploads and data
        if ($request->has('team_members')) {
            $team = [];
            foreach ($request->input('team_members') as $index => $member) {
                $m = [
                    'name' => $member['name'] ?? null,
                    'role' => $member['role'] ?? null,
                    'facebook' => $member['facebook'] ?? null,
                    'twitter' => $member['twitter'] ?? null,
                    'linkedin' => $member['linkedin'] ?? null,
                ];
                if ($request->hasFile("team_members.$index.image")) {
                    $path = $request->file("team_members.$index.image")->store('about_us/team', 'public');
                    $m['image_path'] = $path;
                } else {
                    $m['image_path'] = $member['image_path'] ?? null;
                }
                if ($m['name'] || $m['role'] || $m['image_path']) {
                    $team[] = $m;
                }
            }
            $data['team_members'] = $team;
        }

        AboutUs::updateOrCreate(['id' => 1], $data); // Using id=1 to ensure singleton

        return redirect()->route('admin.about-us.edit')->with('success', 'About Us page updated successfully.');
    }
}
