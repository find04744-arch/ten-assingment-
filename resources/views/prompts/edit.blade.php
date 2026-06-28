@extends('layouts.app')

@section('title', 'Edit Prompt')

@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit Prompt</h1>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('prompts.update', $prompt->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input type="text" name="title" value="{{ $prompt->title }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="3" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ $prompt->description }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Prompt Content</label>
                    <textarea name="content" rows="6" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ $prompt->content }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select name="category" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option value="Writing" @selected($prompt->category === 'Writing')>Writing</option>
                            <option value="Coding" @selected($prompt->category === 'Coding')>Coding</option>
                            <option value="Marketing" @selected($prompt->category === 'Marketing')>Marketing</option>
                            <option value="Business" @selected($prompt->category === 'Business')>Business</option>
                            <option value="Other" @selected($prompt->category === 'Other')>Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">AI Tool</label>
                        <select name="ai_tool" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option value="ChatGPT" @selected($prompt->ai_tool === 'ChatGPT')>ChatGPT</option>
                            <option value="Claude" @selected($prompt->ai_tool === 'Claude')>Claude</option>
                            <option value="Gemini" @selected($prompt->ai_tool === 'Gemini')>Gemini</option>
                            <option value="Other" @selected($prompt->ai_tool === 'Other')>Other</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Difficulty Level</label>
                        <select name="difficulty_level" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option value="beginner" @selected($prompt->difficulty_level === 'beginner')>Beginner</option>
                            <option value="intermediate" @selected($prompt->difficulty_level === 'intermediate')>Intermediate</option>
                            <option value="pro" @selected($prompt->difficulty_level === 'pro')>Pro</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Visibility</label>
                        <select name="visibility" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option value="public" @selected($prompt->visibility === 'public')>Public</option>
                            <option value="private" @selected($prompt->visibility === 'private')>Private</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tags (comma-separated)</label>
                    <input type="text" name="tags" value="{{ implode(',', $prompt->tags ?? []) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                        class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 font-medium">Save
                        Changes</button>
                    <a href="{{ route('my-prompts') }}"
                        class="flex-1 border border-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-50 font-medium text-center">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
