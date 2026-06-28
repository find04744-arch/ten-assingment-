@extends('layouts.app')

@section('title', 'My Reviews')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">My Reviews</h1>

        @if ($reviews->count() > 0)
            <div class="space-y-6 mb-12">
                @foreach ($reviews as $review)
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $review->prompt->title }}</h3>
                                <p class="text-sm text-gray-500">by {{ $review->prompt->user->name }}</p>
                            </div>
                            <div class="text-lg">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    ⭐
                                @endfor
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">{{ $review->comment }}</p>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>{{ $review->created_at->diffForHumans() }}</span>
                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $reviews->links() }}
        @else
            <div class="text-center py-12">
                <p class="text-gray-600">You haven't written any reviews yet.</p>
            </div>
        @endif
    </div>
@endsection
