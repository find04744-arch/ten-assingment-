<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prompt;
use App\Models\Payment;
use App\Models\Report;
use App\Models\Client;
use App\Models\CareerPost;
use App\Models\CareerApplication;
use App\Models\ContactInfo;
use App\Models\ContactMessage;
use App\Models\Certification;
use App\Models\ProductItem;
use App\Models\IndustryItem;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // ─────────────────── Dashboard & Analytics ───────────────────

    public function dashboard()
    {
        $stats = [
            'total_users'    => User::count(),
            'total_prompts'  => Prompt::count(),
            'total_revenue'  => Payment::whereIn('status', ['completed', 'paid'])->sum('amount'),
            'pending_prompts' => Prompt::where('status', 'pending')->count(),
            'pending_reports' => Report::where('status', 'pending')->count(),
        ];

        $recentPrompts = Prompt::with('user')->latest()->take(6)->get();
        $recentUsers   = User::latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recentPrompts', 'recentUsers'));
    }

    public function analytics()
    {
        $data = [
            'users_growth' => User::selectRaw('COUNT(*) as count, DATE(created_at) as date')
                ->groupBy('date')->orderBy('date')->get(),
            'prompts_by_category' => Prompt::selectRaw('category, COUNT(*) as count')
                ->groupBy('category')->get(),
            'revenue_data' => Payment::selectRaw('COUNT(*) as count, SUM(amount) as total, DATE(created_at) as date')
                ->whereIn('status', ['completed', 'paid'])
                ->groupBy('date')->orderBy('date')->get(),
        ];

        return view('admin.analytics', compact('data'));
    }

    // ─────────────────── Users ───────────────────

    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users-create');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|string|min:8|confirmed',
            'role'                  => 'required|in:user,creator,admin',
            'subscription_status'   => 'required|in:free,premium',
            'bio'                   => 'nullable|string|max:1000',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users')->with('status', 'User created successfully!');
    }

    public function editUser(User $user)
    {
        return view('admin.users-edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email,' . $user->id,
            'password'              => 'nullable|string|min:8|confirmed',
            'role'                  => 'required|in:user,creator,admin',
            'subscription_status'   => 'required|in:free,premium',
            'bio'                   => 'nullable|string|max:1000',
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users')->with('status', 'User updated successfully!');
    }

    public function updateUserRole(Request $request, $id)
    {
        $user      = User::findOrFail($id);
        $validated = $request->validate(['role' => 'required|in:user,creator,admin']);
        $user->update($validated);
        return back()->with('status', 'User role updated successfully!');
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('status', 'User deleted successfully!');
    }

    // ─────────────────── Prompts ───────────────────

    public function prompts()
    {
        $prompts      = Prompt::with('user')->latest()->paginate(20);
        $pendingCount = Prompt::where('status', 'pending')->count();
        return view('admin.prompts', compact('prompts', 'pendingCount'));
    }

    public function createPrompt()
    {
        $users = User::orderBy('name')->get(['id', 'name', 'email']);
        return view('admin.prompts-create', compact('users'));
    }

    public function storePrompt(Request $request)
    {
        $validated = $request->validate([
            'user_id'          => 'required|exists:users,id',
            'title'            => 'required|string|max:255',
            'description'      => 'required|string|max:1000',
            'content'          => 'required|string',
            'category'         => 'required|string|max:100',
            'ai_tool'          => 'nullable|string|max:100',
            'tags'             => 'nullable|string',
            'difficulty_level' => 'required|in:beginner,intermediate,pro',
            'visibility'       => 'required|in:public,private',
            'status'           => 'required|in:pending,approved,rejected',
            'is_featured'      => 'boolean',
        ]);

        if (!empty($validated['tags']) && is_string($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        Prompt::create($validated);

        return redirect()->route('admin.prompts')->with('status', 'Prompt created successfully!');
    }

    public function editPrompt(Prompt $prompt)
    {
        $users = User::orderBy('name')->get(['id', 'name', 'email']);
        return view('admin.prompts-edit', compact('prompt', 'users'));
    }

    public function updatePrompt(Request $request, Prompt $prompt)
    {
        $validated = $request->validate([
            'user_id'          => 'required|exists:users,id',
            'title'            => 'required|string|max:255',
            'description'      => 'required|string|max:1000',
            'content'          => 'required|string',
            'category'         => 'required|string|max:100',
            'ai_tool'          => 'nullable|string|max:100',
            'tags'             => 'nullable|string',
            'difficulty_level' => 'required|in:beginner,intermediate,pro',
            'visibility'       => 'required|in:public,private',
            'status'           => 'required|in:pending,approved,rejected',
            'is_featured'      => 'boolean',
        ]);

        if (!empty($validated['tags']) && is_string($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        $prompt->update($validated);

        return redirect()->route('admin.prompts')->with('status', 'Prompt updated successfully!');
    }

    public function approvePrompt($id)
    {
        Prompt::findOrFail($id)->update(['status' => 'approved']);
        return back()->with('status', 'Prompt approved!');
    }

    public function rejectPrompt(Request $request, $id)
    {
        $request->validate(['reason' => 'nullable|string']);
        Prompt::findOrFail($id)->update(['status' => 'rejected']);
        return back()->with('status', 'Prompt rejected!');
    }

    public function deletePrompt($id)
    {
        Prompt::findOrFail($id)->delete();
        return back()->with('status', 'Prompt deleted!');
    }

    public function featurePrompt($id)
    {
        $prompt = Prompt::findOrFail($id);
        $prompt->update(['is_featured' => !$prompt->is_featured]);
        return back()->with('status', 'Prompt featured status updated!');
    }

    // ─────────────────── Payments ───────────────────

    public function payments()
    {
        $payments = Payment::with('user')->latest()->paginate(20);
        return view('admin.payments', compact('payments'));
    }

    public function createPayment()
    {
        $users = User::orderBy('name')->get(['id', 'name', 'email']);
        return view('admin.payments-create', compact('users'));
    }

    public function storePayment(Request $request)
    {
        $validated = $request->validate([
            'user_id'               => 'required|exists:users,id',
            'amount'                => 'required|numeric|min:0',
            'currency'              => 'required|string|max:10',
            'status'                => 'required|in:pending,completed,failed,refunded,paid',
            'payment_method'        => 'nullable|string|max:100',
            'stripe_transaction_id' => 'nullable|string|max:255',
            'payment_date'          => 'nullable|date',
            'description'           => 'nullable|string|max:500',
        ]);

        Payment::create($validated);

        return redirect()->route('admin.payments')->with('status', 'Payment record added successfully!');
    }

    // ─────────────────── Reports ───────────────────

    public function reports()
    {
        $reports = Report::with('user', 'prompt')->latest()->paginate(20);
        return view('admin.reports', compact('reports'));
    }

    public function resolveReport(Report $report)
    {
        $report->update(['status' => 'resolved']);
        return back()->with('status', 'Report resolved!');
    }

    public function dismissReport(Report $report)
    {
        $report->update(['status' => 'dismissed']);
        return back()->with('status', 'Report dismissed!');
    }

    public function warnCreator(Report $report)
    {
        return back()->with('status', 'Warning sent to creator!');
    }

    // ─────────────────── Clients ───────────────────

    public function clients()
    {
        $clients = Client::latest()->paginate(20);
        return view('admin.clients', compact('clients'));
    }

    public function createClient()
    {
        return view('admin.clients-create');
    }

    public function storeClient(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'website_url' => 'nullable|url|max:500',
            'logo'        => 'nullable|image|max:2048',
            'status'      => 'required|boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $request->file('logo')->store('clients', 'public');
        }

        unset($validated['logo']);
        Client::create($validated);

        return redirect()->route('admin.clients')->with('status', 'Client added successfully!');
    }

    public function editClient(Client $client)
    {
        return view('admin.clients-edit', compact('client'));
    }

    public function updateClient(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'website_url' => 'nullable|url|max:500',
            'logo'        => 'nullable|image|max:2048',
            'status'      => 'required|boolean',
        ]);

        if ($request->hasFile('logo')) {
            if ($client->logo_path) Storage::disk('public')->delete($client->logo_path);
            $validated['logo_path'] = $request->file('logo')->store('clients', 'public');
        }

        unset($validated['logo']);
        $client->update($validated);

        return redirect()->route('admin.clients')->with('status', 'Client updated successfully!');
    }

    public function destroyClient(Client $client)
    {
        if ($client->logo_path) Storage::disk('public')->delete($client->logo_path);
        $client->delete();
        return back()->with('status', 'Client deleted successfully!');
    }

    // ─────────────────── Certifications ───────────────────

    public function certifications()
    {
        $certifications = Certification::latest()->paginate(20);
        return view('admin.certifications', compact('certifications'));
    }

    public function createCertification()
    {
        return view('admin.certifications-create');
    }

    public function storeCertification(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'issued_by'   => 'nullable|string|max:255',
            'issued_at'   => 'nullable|date',
            'image'       => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('certifications', 'public');
        }

        unset($validated['image']);
        Certification::create($validated);

        return redirect()->route('admin.certifications')->with('status', 'Certification added successfully!');
    }

    public function editCertification(Certification $certification)
    {
        return view('admin.certifications-edit', compact('certification'));
    }

    public function updateCertification(Request $request, Certification $certification)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'issued_by'   => 'nullable|string|max:255',
            'issued_at'   => 'nullable|date',
            'image'       => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            if ($certification->image_path) Storage::disk('public')->delete($certification->image_path);
            $validated['image_path'] = $request->file('image')->store('certifications', 'public');
        }

        unset($validated['image']);
        $certification->update($validated);

        return redirect()->route('admin.certifications')->with('status', 'Certification updated successfully!');
    }

    public function destroyCertification(Certification $certification)
    {
        if ($certification->image_path) Storage::disk('public')->delete($certification->image_path);
        $certification->delete();
        return back()->with('status', 'Certification deleted!');
    }

    // ─────────────────── Product Items ───────────────────

    public function productItems()
    {
        $items = ProductItem::latest()->paginate(20);
        return view('admin.product-items', compact('items'));
    }

    public function createProductItem()
    {
        return view('admin.product-items-create');
    }

    public function storeProductItem(Request $request)
    {
        $validated = $request->validate([
            'category'    => 'required|string|max:100',
            'subcategory' => 'nullable|string|max:100',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon'        => 'nullable|string|max:255',
            'item_type'   => 'nullable|string|max:100',
            'image'       => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('products', 'public');
        }

        unset($validated['image']);
        ProductItem::create($validated);

        return redirect()->route('admin.product-items')->with('status', 'Product item added successfully!');
    }

    public function editProductItem(ProductItem $item)
    {
        return view('admin.product-items-edit', compact('item'));
    }

    public function updateProductItem(Request $request, ProductItem $item)
    {
        $validated = $request->validate([
            'category'    => 'required|string|max:100',
            'subcategory' => 'nullable|string|max:100',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon'        => 'nullable|string|max:255',
            'item_type'   => 'nullable|string|max:100',
            'image'       => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            if ($item->image_path) Storage::disk('public')->delete($item->image_path);
            $validated['image_path'] = $request->file('image')->store('products', 'public');
        }

        unset($validated['image']);
        $item->update($validated);

        return redirect()->route('admin.product-items')->with('status', 'Product item updated successfully!');
    }

    public function destroyProductItem(ProductItem $item)
    {
        if ($item->image_path) Storage::disk('public')->delete($item->image_path);
        $item->delete();
        return back()->with('status', 'Product item deleted!');
    }

    // ─────────────────── Industry Items ───────────────────

    public function industryItems()
    {
        $items = IndustryItem::latest()->paginate(20);
        return view('admin.industry-items', compact('items'));
    }

    public function createIndustryItem()
    {
        return view('admin.industry-items-create');
    }

    public function storeIndustryItem(Request $request)
    {
        $validated = $request->validate([
            'category'    => 'required|string|max:100',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('industries', 'public');
        }

        unset($validated['image']);
        IndustryItem::create($validated);

        return redirect()->route('admin.industry-items')->with('status', 'Industry item added successfully!');
    }

    public function editIndustryItem(IndustryItem $item)
    {
        return view('admin.industry-items-edit', compact('item'));
    }

    public function updateIndustryItem(Request $request, IndustryItem $item)
    {
        $validated = $request->validate([
            'category'    => 'required|string|max:100',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            if ($item->image_path) Storage::disk('public')->delete($item->image_path);
            $validated['image_path'] = $request->file('image')->store('industries', 'public');
        }

        unset($validated['image']);
        $item->update($validated);

        return redirect()->route('admin.industry-items')->with('status', 'Industry item updated successfully!');
    }

    public function destroyIndustryItem(IndustryItem $item)
    {
        if ($item->image_path) Storage::disk('public')->delete($item->image_path);
        $item->delete();
        return back()->with('status', 'Industry item deleted!');
    }

    // ─────────────────── Career Posts ───────────────────

    public function careerPosts()
    {
        $posts = CareerPost::latest()->paginate(20);
        return view('admin.career-posts', compact('posts'));
    }

    public function createCareerPost()
    {
        return view('admin.career-posts-create');
    }

    public function storeCareerPost(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'type'        => 'required|string|max:100',
            'experience'  => 'nullable|string|max:100',
            'salary'      => 'nullable|string|max:100',
            'location'    => 'nullable|string|max:255',
            'deadline'    => 'nullable|date',
            'description' => 'required|string',
            'is_active'   => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        CareerPost::create($validated);

        return redirect()->route('admin.career-posts')->with('status', 'Career post published successfully!');
    }

    public function editCareerPost(CareerPost $post)
    {
        return view('admin.career-posts-edit', compact('post'));
    }

    public function updateCareerPost(Request $request, CareerPost $post)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'type'        => 'required|string|max:100',
            'experience'  => 'nullable|string|max:100',
            'salary'      => 'nullable|string|max:100',
            'location'    => 'nullable|string|max:255',
            'deadline'    => 'nullable|date',
            'description' => 'required|string',
            'is_active'   => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $post->update($validated);

        return redirect()->route('admin.career-posts')->with('status', 'Career post updated successfully!');
    }

    public function destroyCareerPost(CareerPost $post)
    {
        $post->delete();
        return back()->with('status', 'Career post deleted!');
    }

    // ─────────────────── Career Applications ───────────────────

    public function careerApplications()
    {
        $applications = CareerApplication::latest()->paginate(20);
        return view('admin.career-applications', compact('applications'));
    }

    public function showCareerApplication(CareerApplication $application)
    {
        return view('admin.career-applications-show', compact('application'));
    }

    public function destroyCareerApplication(CareerApplication $application)
    {
        if ($application->resume_path) Storage::disk('public')->delete($application->resume_path);
        $application->delete();
        return redirect()->route('admin.career-applications')->with('status', 'Application deleted!');
    }

    // ─────────────────── Contact Messages ───────────────────

    public function contactMessages()
    {
        $messages = ContactMessage::latest()->paginate(20);
        return view('admin.contact-messages', compact('messages'));
    }

    public function showContactMessage(ContactMessage $message)
    {
        return view('admin.contact-messages-show', compact('message'));
    }

    public function destroyContactMessage(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.contact-messages')->with('status', 'Message deleted!');
    }

    // ─────────────────── Contact Info (singleton) ───────────────────

    public function contactInfo()
    {
        $info = ContactInfo::first() ?? new ContactInfo();
        return view('admin.contact-info', compact('info'));
    }

    public function updateContactInfo(Request $request)
    {
        $validated = $request->validate([
            'phone'                       => 'nullable|string|max:50',
            'email'                       => 'nullable|email|max:255',
            'address'                     => 'nullable|string|max:500',
            'map_embed'                   => 'nullable|string',
            'form_title'                  => 'nullable|string|max:255',
            'form_description'            => 'nullable|string',
            'twitter_url'                 => 'nullable|url|max:500',
            'facebook_url'                => 'nullable|url|max:500',
            'contact_section_title'       => 'nullable|string|max:255',
            'contact_section_heading'     => 'nullable|string|max:255',
            'contact_section_description' => 'nullable|string',
            'head_office_title'           => 'nullable|string|max:255',
            'branch_office_title'         => 'nullable|string|max:255',
            'branch_office_address'       => 'nullable|string|max:500',
            'branch_office_phone'         => 'nullable|string|max:50',
            'branch_office_email'         => 'nullable|email|max:255',
        ]);

        ContactInfo::updateOrCreate(['id' => 1], $validated);

        return back()->with('status', 'Contact information updated successfully!');
    }

    // ─────────────────── About Us (singleton) ───────────────────

    public function aboutUs()
    {
        $about = AboutUs::first() ?? new AboutUs();
        return view('admin.about', compact('about'));
    }

    public function updateAboutUs(Request $request)
    {
        $validated = $request->validate([
            'experience_years'         => 'nullable|integer',
            'experience_title'         => 'nullable|string|max:255',
            'intro_subtitle'           => 'nullable|string|max:255',
            'intro_title'              => 'nullable|string|max:255',
            'intro_description_1'      => 'nullable|string',
            'intro_description_2'      => 'nullable|string',
            'intro_features'           => 'nullable|string',
            'mission_title'            => 'nullable|string|max:255',
            'mission_description'      => 'nullable|string',
            'vision_title'             => 'nullable|string|max:255',
            'vision_description'       => 'nullable|string',
            'values_title'             => 'nullable|string|max:255',
            'values_description'       => 'nullable|string',
            'values_list'              => 'nullable|string',
            'why_choose_subtitle'      => 'nullable|string|max:255',
            'why_choose_title'         => 'nullable|string|max:255',
            'why_choose_description'   => 'nullable|string',
            'why_choose_features'      => 'nullable|string',
            'cta_title'                => 'nullable|string|max:255',
            'cta_description'          => 'nullable|string',
            'cta_button_text'          => 'nullable|string|max:100',
            'cta_button_link'          => 'nullable|string|max:500',
            'intro_image'              => 'nullable|image|max:4096',
        ]);

        // Convert newline-separated text to JSON arrays
        foreach (['intro_features', 'values_list', 'why_choose_features'] as $field) {
            if (!empty($validated[$field])) {
                $validated[$field] = array_values(array_filter(array_map('trim', explode("\n", $validated[$field]))));
            }
        }

        if ($request->hasFile('intro_image')) {
            $about = AboutUs::first();
            if ($about && $about->intro_image_path) Storage::disk('public')->delete($about->intro_image_path);
            $validated['intro_image_path'] = $request->file('intro_image')->store('about', 'public');
        }

        unset($validated['intro_image']);
        AboutUs::updateOrCreate(['id' => 1], $validated);

        return back()->with('status', 'About Us content updated successfully!');
    }
}
