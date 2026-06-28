@extends('layouts.app')

@section('title', 'Saved Prompts')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Saved Prompts</h1>

        @if ($bookmarks->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach ($bookmarks as $bookmark)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $bookmark->prompt->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($bookmark->prompt->description, 100) }}</p>

                            <div class="space-y-2 mb-4 text-sm text-gray-500">
                                <div class="flex justify-between">
                                    <span>Category:</span>
                                    <span class="font-medium">{{ $bookmark->prompt->category }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Copies:</span>
                                    <span class="font-medium">{{ $bookmark->prompt->copy_count }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>By:</span>
                                    <span class="font-medium">{{ $bookmark->prompt->user->name }}</span>
                                </div>
                            </div>

                            <a href="{{ route('prompts.show', $bookmark->prompt->id) }}"
                                class="block w-full text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700 font-medium">View
                                Prompt</a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $bookmarks->links() }}
        @else
            <div class="text-center py-12">
                <p class="text-gray-600 mb-4">You haven't saved any prompts yet.</p>
                <a href="{{ route('prompts.all') }}"
                    class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-medium">
                    Explore Prompts
                </a>
            </div>
        @endif
    </div>
@endsection
