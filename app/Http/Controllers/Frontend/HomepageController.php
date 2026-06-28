<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CareerApplication;
use App\Models\CareerPost;
use App\Models\Certification;
use App\Models\Client;
use App\Models\ContactInfo;
use App\Models\ContactMessage;
use App\Models\ProductItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// use App\Models\Page; // Reference for future dynamic content

class HomepageController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        // Example: $sliders = Slider::all();
        return view('frontend.pages.home');
    }

    /**
     * Display the about us page.
     */
    public function aboutUs()
    {
        $aboutUs = \App\Models\AboutUs::first();

        return view('frontend.pages.aboutus', compact('aboutUs'));
    }

    /**
     * Display the career page.
     */
    public function career()
    {
        $careerPosts = CareerPost::where('is_active', true)->latest()->get()->groupBy('category');

        return view('frontend.pages.career', compact('careerPosts'));
    }

    /**
     * Display the certifications page.
     */
    public function certifications()
    {
        $certifications = Certification::latest()->get();

        return view('frontend.pages.certifications', compact('certifications'));
    }

    /**
     * Display the contact us page.
     */
    public function contactUs()
    {
        $contactInfo = ContactInfo::first();

        return view('frontend.pages.contactus', compact('contactInfo'));
    }

    /**
     * Store contact message.
     */
    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($request->all());

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    public function storeCareerApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'department' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'message' => ['nullable', 'string'],
            'resume' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            return redirect()->to(route('career').'#apply-form')->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $resumePath = $request->file('resume')->store('career-resumes', 'public');

        CareerApplication::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'department' => $data['department'] ?? null,
            'type' => $data['type'] ?? null,
            'message' => $data['message'] ?? null,
            'resume_path' => $resumePath,
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'message' => 'Your application has been submitted successfully.',
            ]);
        }

        return redirect()->to(route('career').'#apply-form')->with('success', 'Your application has been submitted successfully.');
    }

    /**
     * Display the our clients page.
     */
    public function ourClients()
    {
        $clients = Client::where('status', true)->latest()->get();

        return view('frontend.pages.ourclients', compact('clients'));
    }

    // Industries
    public function apparels()
    {
        return view('frontend.pages.industries.apparels');
    }

    public function design()
    {
        return view('frontend.pages.industries.design');
    }

    public function dresses()
    {
        return view('frontend.pages.industries.dresses');
    }

    public function washingPlant()
    {
        return view('frontend.pages.industries.washingplant');
    }

    public function togs()
    {
        return view('frontend.pages.industries.togs');
    }

    // Products
    public function mens()
    {
        $products = ProductItem::where('category', 'mens')->where('item_type', '!=', 'gallery')->get();
        $gallery = ProductItem::where('category', 'mens')->where('item_type', 'gallery')->latest()->get();
        $galleryCategories = $gallery->pluck('subcategory')->filter()->unique()->values();

        return view('frontend.pages.products.mens', compact('products', 'gallery', 'galleryCategories'));
    }

    public function womens()
    {
        $products = ProductItem::where('category', 'womens')->where('item_type', '!=', 'gallery')->get();
        $gallery = ProductItem::where('category', 'womens')->where('item_type', 'gallery')->latest()->get();
        $galleryCategories = $gallery->pluck('subcategory')->filter()->unique()->values();

        return view('frontend.pages.products.womens', compact('products', 'gallery', 'galleryCategories'));
    }

    public function kids()
    {
        $products = ProductItem::where('category', 'kids')->where('item_type', '!=', 'gallery')->get();
        $gallery = ProductItem::where('category', 'kids')->where('item_type', 'gallery')->latest()->get();
        $galleryCategories = $gallery->pluck('subcategory')->filter()->unique()->values();

        return view('frontend.pages.products.kids', compact('products', 'gallery', 'galleryCategories'));
    }
}
