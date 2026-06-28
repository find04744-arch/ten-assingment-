@extends('layouts.app')

@section('title', 'Creator Analytics')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Analytics</h1>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Prompt Title</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Copies</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Reviews</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Rating</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Bookmarks</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($analyticsData ?? [] as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item['title'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item['copies'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item['reviews'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">⭐ {{ number_format($item['rating'], 1) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item['bookmarks'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">No analytics data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
