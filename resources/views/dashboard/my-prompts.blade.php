@extends('layouts.app')

@section('title', 'My Prompts')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">My Prompts</h1>
            <a href="{{ route('prompts.create') }}"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-medium">
                ➕ Create Prompt
            </a>
        </div>

        @if ($prompts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach ($prompts as $prompt)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $prompt->title }}</h3>
                                <span
                                    class="px-2 py-1 rounded text-xs font-semibold {{ $prompt->status === 'approved' ? 'bg-green-100 text-green-800' : ($prompt->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($prompt->status) }}
                                </span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($prompt->description, 100) }}</p>

                            <div class="space-y-2 mb-4 text-sm text-gray-500">
                                <div class="flex justify-between">
                                    <span>Category:</span>
                                    <span class="font-medium">{{ $prompt->category }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Copies:</span>
                                    <span class="font-medium">{{ $prompt->copy_count }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Rating:</span>
                                    <span class="font-medium">⭐ {{ round($prompt->averageRating(), 1) }}</span>
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ route('prompts.show', $prompt->id) }}"
                                    class="flex-1 text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700 font-medium text-sm">View</a>
                                <a href="{{ route('prompts.edit', $prompt->id) }}"
                                    class="flex-1 text-center border border-blue-600 text-blue-600 py-2 rounded hover:bg-blue-50 font-medium text-sm">Edit</a>
                                <form action="{{ route('prompts.destroy', $prompt->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700 font-medium text-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $prompts->links() }}
        @else
            <div class="text-center py-12">
                <p class="text-gray-600 mb-4">You haven't created any prompts yet.</p>
                <a href="{{ route('prompts.create') }}"
                    class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-medium">
                    Create Your First Prompt
                </a>
            </div>
        @endif
    </div>
@endsection
