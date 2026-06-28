@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-600 mt-2">Welcome back, {{ auth()->user()->name }}!</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-1">
                        <p class="text-gray-600">Total Prompts</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $promptsCount }}</p>
                    </div>
                    <div class="text-4xl text-blue-500">📝</div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-1">
                        <p class="text-gray-600">Bookmarks</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $bookmarks }}</p>
                    </div>
                    <div class="text-4xl text-red-500">❤️</div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-1">
                        <p class="text-gray-600">Reviews</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $reviews }}</p>
                    </div>
                    <div class="text-4xl text-yellow-500">⭐</div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-1">
                        <p class="text-gray-600">Total Copies</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalCopies }}</p>
                    </div>
                    <div class="text-4xl text-green-500">📋</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('prompts.create') }}"
                    class="block bg-blue-600 text-white p-4 rounded-lg hover:bg-blue-700 text-center font-medium">
                    ➕ Create New Prompt
                </a>
                <a href="{{ route('my-prompts') }}"
                    class="block bg-gray-600 text-white p-4 rounded-lg hover:bg-gray-700 text-center font-medium">
                    📝 View My Prompts
                </a>
                <a href="{{ route('saved-prompts') }}"
                    class="block bg-red-600 text-white p-4 rounded-lg hover:bg-red-700 text-center font-medium">
                    ❤️ View Saved Prompts
                </a>
            </div>
        </div>

        @if (auth()->user()->subscription_status !== 'premium')
            <div class="mt-8 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-bold mb-2">Upgrade to Premium</h2>
                <p class="mb-4">Get unlimited prompts and unlock exclusive features</p>
                <a href="{{ route('payment') }}"
                    class="inline-block bg-white text-blue-600 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100">
                    Upgrade Now - $5
                </a>
            </div>
        @endif
    </div>
@endsection
