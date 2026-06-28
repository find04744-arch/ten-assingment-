@extends('layouts.app')

@section('title', 'All Prompts')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold mb-2">All Prompts</h1>
        <p class="text-gray-600 mb-8">Browse and search through thousands of prompts</p>

        <!-- Filter Section -->
        <div class="mb-8">
            <form method="GET" action="{{ route('prompts.all') }}" id="filter-form" class="bg-white rounded-lg shadow-md p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search prompts..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select name="category"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Categories</option>
                            <option value="Writing" @selected(request('category') === 'Writing')>Writing</option>
                            <option value="Coding" @selected(request('category') === 'Coding')>Coding</option>
                            <option value="Marketing" @selected(request('category') === 'Marketing')>Marketing</option>
                            <option value="Business" @selected(request('category') === 'Business')>Business</option>
                            <option value="Other" @selected(request('category') === 'Other')>Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Difficulty</label>
                        <select name="difficulty"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Levels</option>
                            <option value="beginner" @selected(request('difficulty') === 'beginner')>Beginner</option>
                            <option value="intermediate" @selected(request('difficulty') === 'intermediate')>Intermediate</option>
                            <option value="pro" @selected(request('difficulty') === 'pro')>Pro</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                        <select name="sort"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option value="latest" @selected(request('sort') === 'latest')>Latest</option>
                            <option value="popular" @selected(request('sort') === 'popular')>Most Popular</option>
                            <option value="rating" @selected(request('sort') === 'rating')>Highest Rated</option>
                            <option value="copies" @selected(request('sort') === 'copies')>Most Copied</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex gap-4">
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-medium">Apply
                        Filters</button>
                    <a href="{{ route('prompts.all') }}"
                        class="border border-gray-300 px-6 py-2 rounded-lg hover:bg-gray-50">Clear</a>
                </div>
            </form>
        </div>

        <!-- Prompts Grid -->
        @if ($prompts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach ($prompts as $prompt)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden">
                        @if ($prompt->thumbnail_image)
                            <img src="{{ asset('storage/' . $prompt->thumbnail_image) }}" alt="{{ $prompt->title }}"
                                class="w-full h-40 object-cover">
                        @else
                            <div
                                class="w-full h-40 bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                                <span class="text-white text-4xl">{{ substr($prompt->ai_tool, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $prompt->title }}</h3>
                                @auth
                                    <button data-bookmark-btn data-prompt-id="{{ $prompt->id }}"
                                        class="text-gray-400 hover:text-red-500 transition">
                                        @if (auth()->user()->bookmarks()->where('prompt_id', $prompt->id)->exists())
                                            <span class="text-red-500">❤️</span>
                                        @else
                                            <span>🤍</span>
                                        @endif
                                    </button>
                                @endauth
                            </div>
                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($prompt->description, 80) }}</p>
                            <div class="flex items-center justify-between mb-4 text-sm">
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ $prompt->ai_tool }}</span>
                                <span class="bg-gray-100 px-2 py-1 rounded">{{ $prompt->difficulty_level }}</span>
                            </div>
                            <div class="flex items-center justify-between mb-4 text-xs text-gray-500">
                                <span>by {{ $prompt->user->name }}</span>
                                <span>⭐ {{ round($prompt->averageRating(), 1) }}</span>
                            </div>
                            <a href="{{ route('prompts.show', $prompt->id) }}"
                                class="block w-full text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 font-medium">View
                                Prompt</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center">
                {{ $prompts->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-600">No prompts found. Try adjusting your filters.</p>
            </div>
        @endif
    </div>
@endsection
