<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\CareerPost;
use App\Models\Certification;
use App\Models\Client;
use App\Models\IndustryItem;
use App\Models\ProductItem;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClients = Client::count();
        $totalProducts = ProductItem::count();
        $totalIndustries = IndustryItem::count();
        $totalCertifications = Certification::count();
        $totalCareers = CareerPost::count();
        $aboutUs = AboutUs::first();

        return view('backend.pages.dashboard', compact(
            'totalClients',
            'totalProducts',
            'totalIndustries',
            'totalCertifications',
            'totalCareers',
            'aboutUs'
        ));
    }
}
