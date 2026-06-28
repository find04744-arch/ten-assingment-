@extends('layouts.app')

@section('title', $prompt->title)

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $prompt->title }}</h1>
                            <p class="text-gray-600 mt-2">by <strong>{{ $prompt->user->name }}</strong></p>
                        </div>
                        @auth
                            @if (auth()->user()->id === $prompt->user_id)
                                <div class="flex gap-2">
                                    <a href="{{ route('prompts.edit', $prompt->id) }}"
                                        class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                                </div>
                            @endif
                        @endauth
                    </div>

                    <div class="flex gap-4 mb-6 flex-wrap">
                        <span
                            class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">{{ $prompt->category }}</span>
                        <span
                            class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">{{ $prompt->ai_tool }}</span>
                        <span
                            class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">{{ ucfirst($prompt->difficulty_level) }}</span>
                    </div>

                    <p class="text-gray-700 mb-6">{{ $prompt->description }}</p>

                    <div class="bg-gray-50 p-6 rounded-lg mb-6 max-h-96 overflow-y-auto">
                        <h3 class="font-semibold text-gray-900 mb-3">Prompt Content</h3>
                        <p class="text-gray-700 whitespace-pre-wrap font-mono text-sm">{{ $prompt->content }}</p>
                    </div>

                    <div class="flex gap-4">
                        @auth
                            <button data-bookmark-btn data-prompt-id="{{ $prompt->id }}"
                                class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                                {{ $isBookmarked ? '❤️ Bookmarked' : '🤍 Bookmark' }}
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">🤍 Bookmark</a>
                        @endauth
                    </div>
                </div>

                <!-- Reviews -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Reviews</h2>

                    @auth
                        <form id="review-form" data-prompt-id="{{ $prompt->id }}" method="POST"
                            action="{{ route('prompts.review', $prompt->id) }}" class="mb-8 pb-8 border-b">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Your Rating</label>
                                <div class="flex gap-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <label class="cursor-pointer">
                                            <input type="radio" name="rating" value="{{ $i }}" required
                                                class="hidden">
                                            <span class="text-3xl hover:text-yellow-400">⭐</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Your Comment</label>
                                <textarea name="comment" rows="3" placeholder="Share your thoughts..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg"></textarea>
                            </div>
                            <button type="submit"
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-medium">Submit
                                Review</button>
                        </form>
                    @else
                        <p class="mb-8 pb-8 border-b text-gray-600"><a href="{{ route('login') }}"
                                class="text-blue-600 hover:text-blue-800">Log in</a> to leave a review</p>
                    @endauth

                    @if ($reviews->count() > 0)
                        <div class="space-y-6">
                            @foreach ($reviews as $review)
                                <div class="pb-6 border-b last:border-b-0">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $review->user->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                                        </div>
                                        <p class="text-lg">
                                            @for ($i = 0; $i < $review->rating; $i++)
                                                ⭐
                                            @endfor
                                        </p>
                                    </div>
                                    <p class="text-gray-700">{{ $review->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                        {{ $reviews->links() }}
                    @else
                        <p class="text-gray-500 text-center py-8">No reviews yet. Be the first to review!</p>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <div class="bg-white rounded-lg shadow p-6 sticky top-4">
                    <h3 class="font-bold text-gray-900 mb-4">Stats</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-600">Average Rating</p>
                            <p class="text-2xl font-bold text-gray-900">{{ round($prompt->averageRating(), 1) }} ⭐</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Reviews</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $reviews->total() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Times Copied</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $prompt->copy_count }}</p>
                        </div>
                    </div>

                    @auth
                        <div class="mt-6 pt-6 border-t">
                            <form action="{{ route('prompts.bookmark', $prompt->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 font-medium">
                                    {{ $isBookmarked ? '❤️ Remove Bookmark' : '🤍 Add Bookmark' }}
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endsection
