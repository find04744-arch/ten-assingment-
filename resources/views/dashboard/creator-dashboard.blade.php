@extends('layouts.app')

@section('title', 'Creator Dashboard')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Creator Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Total Prompts</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_prompts'] ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Total Copies</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_copies'] ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Total Reviews</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_reviews'] ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Avg Rating</p>
                <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['avg_rating'] ?? 0, 1) }} ⭐</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Quick Links</h2>
                <div class="space-y-3">
                    <a href="{{ route('my-prompts') }}"
                        class="block p-3 border border-gray-300 rounded-lg hover:bg-gray-50">View My Prompts</a>
                    <a href="{{ route('creator.analytics') }}"
                        class="block p-3 border border-gray-300 rounded-lg hover:bg-gray-50">View Analytics</a>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Bookmarks</h2>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_bookmarks'] ?? 0 }}</p>
                <p class="text-sm text-gray-500">Total bookmarks from users</p>
            </div>
        </div>
    </div>
@endsection
