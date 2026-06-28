<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromptController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

// Public routes
Route::get('/', [PromptController::class, 'index'])->name('home');
Route::get('/prompts', [PromptController::class, 'allPrompts'])->name('prompts.all');
Route::get('/prompts/{id}', [PromptController::class, 'show'])->name('prompts.show');

// Protected user routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');

    // User prompts
    Route::get('/my-prompts', [PromptController::class, 'myPrompts'])->name('my-prompts');
    Route::get('/prompts/create', [PromptController::class, 'create'])->name('prompts.create');
    Route::post('/prompts', [PromptController::class, 'store'])->name('prompts.store');
    Route::get('/prompts/{id}/edit', [PromptController::class, 'edit'])->name('prompts.edit');
    Route::put('/prompts/{id}', [PromptController::class, 'update'])->name('prompts.update');
    Route::delete('/prompts/{id}', [PromptController::class, 'destroy'])->name('prompts.destroy');

    // Bookmarks
    Route::get('/saved-prompts', [DashboardController::class, 'savedPrompts'])->name('saved-prompts');
    Route::post('/prompts/{id}/bookmark', [PromptController::class, 'toggleBookmark'])->name('prompts.bookmark');

    // Reviews
    Route::get('/my-reviews', [DashboardController::class, 'myReviews'])->name('my-reviews');
    Route::post('/prompts/{id}/review', [PromptController::class, 'storeReview'])->name('prompts.review');
    Route::delete('/reviews/{id}', [PromptController::class, 'destroyReview'])->name('reviews.destroy');

    // Payment
    Route::get('/payment', [DashboardController::class, 'payment'])->name('payment');
    Route::post('/payment/checkout', [DashboardController::class, 'createCheckout'])->name('payment.checkout');
    Route::get('/payment/success', [DashboardController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment/cancel', [DashboardController::class, 'paymentCancel'])->name('payment.cancel');

    // Creator routes
    Route::middleware('is_creator')->prefix('creator')->name('creator.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'creatorDashboard'])->name('dashboard');
        Route::get('/analytics', [DashboardController::class, 'creatorAnalytics'])->name('analytics');
    });

    // Report prompt
    Route::post('/prompts/{id}/report', [PromptController::class, 'report'])->name('prompts.report');
});

// Admin routes
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    // ── Dashboard & Analytics ──
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');

    // ── User Management ──
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::put('/users/{id}/role', [AdminController::class, 'updateUserRole'])->name('users.update-role');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');

    // ── Prompt Management ──
    Route::get('/prompts', [AdminController::class, 'prompts'])->name('prompts');
    Route::get('/prompts/create', [AdminController::class, 'createPrompt'])->name('prompts.create');
    Route::post('/prompts', [AdminController::class, 'storePrompt'])->name('prompts.store');
    Route::get('/prompts/{prompt}/edit', [AdminController::class, 'editPrompt'])->name('prompts.edit');
    Route::put('/prompts/{prompt}/update', [AdminController::class, 'updatePrompt'])->name('prompts.update');
    Route::put('/prompts/{id}/approve', [AdminController::class, 'approvePrompt'])->name('prompts.approve');
    Route::put('/prompts/{id}/reject', [AdminController::class, 'rejectPrompt'])->name('prompts.reject');
    Route::delete('/prompts/{id}', [AdminController::class, 'deletePrompt'])->name('prompts.delete');
    Route::put('/prompts/{id}/feature', [AdminController::class, 'featurePrompt'])->name('prompts.feature');

    // ── Payment Management ──
    Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
    Route::get('/payments/create', [AdminController::class, 'createPayment'])->name('payments.create');
    Route::post('/payments', [AdminController::class, 'storePayment'])->name('payments.store');

    // ── Report Management ──
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    Route::put('/reports/{id}/resolve', [AdminController::class, 'resolveReport'])->name('reports.resolve');
    Route::put('/reports/{id}/dismiss', [AdminController::class, 'dismissReport'])->name('reports.dismiss');
    Route::put('/reports/{id}/warn-creator', [AdminController::class, 'warnCreator'])->name('reports.warn-creator');

    // ── Clients ──
    Route::get('/clients', [AdminController::class, 'clients'])->name('clients');
    Route::get('/clients/create', [AdminController::class, 'createClient'])->name('clients.create');
    Route::post('/clients', [AdminController::class, 'storeClient'])->name('clients.store');
    Route::get('/clients/{client}/edit', [AdminController::class, 'editClient'])->name('clients.edit');
    Route::put('/clients/{client}', [AdminController::class, 'updateClient'])->name('clients.update');
    Route::delete('/clients/{client}', [AdminController::class, 'destroyClient'])->name('clients.destroy');

    // ── Certifications ──
    Route::get('/certifications', [AdminController::class, 'certifications'])->name('certifications');
    Route::get('/certifications/create', [AdminController::class, 'createCertification'])->name('certifications.create');
    Route::post('/certifications', [AdminController::class, 'storeCertification'])->name('certifications.store');
    Route::get('/certifications/{certification}/edit', [AdminController::class, 'editCertification'])->name('certifications.edit');
    Route::put('/certifications/{certification}', [AdminController::class, 'updateCertification'])->name('certifications.update');
    Route::delete('/certifications/{certification}', [AdminController::class, 'destroyCertification'])->name('certifications.destroy');

    // ── Product Items ──
    Route::get('/product-items', [AdminController::class, 'productItems'])->name('product-items');
    Route::get('/product-items/create', [AdminController::class, 'createProductItem'])->name('product-items.create');
    Route::post('/product-items', [AdminController::class, 'storeProductItem'])->name('product-items.store');
    Route::get('/product-items/{item}/edit', [AdminController::class, 'editProductItem'])->name('product-items.edit');
    Route::put('/product-items/{item}', [AdminController::class, 'updateProductItem'])->name('product-items.update');
    Route::delete('/product-items/{item}', [AdminController::class, 'destroyProductItem'])->name('product-items.destroy');

    // ── Industry Items ──
    Route::get('/industry-items', [AdminController::class, 'industryItems'])->name('industry-items');
    Route::get('/industry-items/create', [AdminController::class, 'createIndustryItem'])->name('industry-items.create');
    Route::post('/industry-items', [AdminController::class, 'storeIndustryItem'])->name('industry-items.store');
    Route::get('/industry-items/{item}/edit', [AdminController::class, 'editIndustryItem'])->name('industry-items.edit');
    Route::put('/industry-items/{item}', [AdminController::class, 'updateIndustryItem'])->name('industry-items.update');
    Route::delete('/industry-items/{item}', [AdminController::class, 'destroyIndustryItem'])->name('industry-items.destroy');

    // ── Career Posts ──
    Route::get('/career-posts', [AdminController::class, 'careerPosts'])->name('career-posts');
    Route::get('/career-posts/create', [AdminController::class, 'createCareerPost'])->name('career-posts.create');
    Route::post('/career-posts', [AdminController::class, 'storeCareerPost'])->name('career-posts.store');
    Route::get('/career-posts/{post}/edit', [AdminController::class, 'editCareerPost'])->name('career-posts.edit');
    Route::put('/career-posts/{post}', [AdminController::class, 'updateCareerPost'])->name('career-posts.update');
    Route::delete('/career-posts/{post}', [AdminController::class, 'destroyCareerPost'])->name('career-posts.destroy');

    // ── Career Applications ──
    Route::get('/career-applications', [AdminController::class, 'careerApplications'])->name('career-applications');
    Route::get('/career-applications/{application}', [AdminController::class, 'showCareerApplication'])->name('career-applications.show');
    Route::delete('/career-applications/{application}', [AdminController::class, 'destroyCareerApplication'])->name('career-applications.destroy');

    // ── Contact Messages ──
    Route::get('/contact-messages', [AdminController::class, 'contactMessages'])->name('contact-messages');
    Route::get('/contact-messages/{message}', [AdminController::class, 'showContactMessage'])->name('contact-messages.show');
    Route::delete('/contact-messages/{message}', [AdminController::class, 'destroyContactMessage'])->name('contact-messages.destroy');

    // ── Contact Info (singleton) ──
    Route::get('/contact-info', [AdminController::class, 'contactInfo'])->name('contact-info');
    Route::post('/contact-info', [AdminController::class, 'updateContactInfo'])->name('contact-info.update');

    // ── About Us (singleton) ──
    Route::get('/about', [AdminController::class, 'aboutUs'])->name('about');
    Route::post('/about', [AdminController::class, 'updateAboutUs'])->name('about.update');
});

require __DIR__ . '/auth.php';
