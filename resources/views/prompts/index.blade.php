@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-4">Welcome to PromptHub</h1>
            <p class="text-xl text-blue-100 mb-8">Discover, share, and monetize AI prompts with our thriving community</p>
            <div class="space-x-4">
                <a href="{{ route('prompts.all') }}"
                    class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100">Explore
                    Prompts</a>
                @guest
                    <a href="{{ route('register') }}"
                        class="inline-block border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700">Get
                        Started</a>
                @else
                    <a href="{{ route('prompts.create') }}"
                        class="inline-block border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700">Create
                        Prompt</a>
                @endguest
            </div>
        </div>
    </div>

    <!-- Featured Prompts -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-3xl font-bold mb-4">Featured Prompts</h2>
        <p class="text-gray-600 mb-8">Check out the latest and most popular prompts from our community</p>

        @if ($featured->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($featured as $prompt)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-6">
                        @if ($prompt->thumbnail_image)
                            <img src="{{ asset('storage/' . $prompt->thumbnail_image) }}" alt="{{ $prompt->title }}"
                                class="w-full h-40 object-cover rounded-lg mb-4">
                        @else
                            <div
                                class="w-full h-40 bg-gradient-to-r from-blue-400 to-blue-600 rounded-lg mb-4 flex items-center justify-center">
                                <span class="text-white text-2xl">{{ substr($prompt->ai_tool, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $prompt->title }}</h3>
                            <span
                                class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-semibold">{{ $prompt->ai_tool }}</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-2">{{ Str::limit($prompt->description, 100) }}</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs text-gray-500">by {{ $prompt->user->name }}</span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $prompt->difficulty_level }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">⭐ {{ round($prompt->averageRating(), 1) }}
                                ({{ $prompt->reviews->count() }})</span>
                            <a href="{{ route('prompts.show', $prompt->id) }}"
                                class="text-blue-600 hover:text-blue-800 font-semibold">View →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-600">No featured prompts yet. Check back soon!</p>
            </div>
        @endif
    </div>

    <!-- Stats -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div>
                    <p class="text-4xl font-bold text-blue-600">{{ \App\Models\Prompt::count() }}</p>
                    <p class="text-gray-600 mt-2">Total Prompts</p>
                </div>
                <div>
                    <p class="text-4xl font-bold text-blue-600">{{ \App\Models\User::count() }}</p>
                    <p class="text-gray-600 mt-2">Active Users</p>
                </div>
                <div>
                    <p class="text-4xl font-bold text-blue-600">{{ \App\Models\Review::count() }}</p>
                    <p class="text-gray-600 mt-2">Reviews</p>
                </div>
                <div>
                    <p class="text-4xl font-bold text-blue-600">{{ \App\Models\Bookmark::count() }}</p>
                    <p class="text-gray-600 mt-2">Bookmarks</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-blue-600 text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to share your prompts?</h2>
            <p class="text-xl text-blue-100 mb-8">Join thousands of creators earning money from their prompts</p>
            @guest
                <a href="{{ route('register') }}"
                    class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100">Create
                    Account</a>
            @else
                <a href="{{ route('prompts.create') }}"
                    class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100">Start
                    Creating</a>
            @endguest
        </div>
    </div>
@endsection
