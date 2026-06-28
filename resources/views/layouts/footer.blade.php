<footer class="bg-gray-900 text-gray-300 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <!-- About -->
            <div>
                <h3 class="text-white font-bold text-lg mb-4">PromptHub</h3>
                <p class="text-sm text-gray-400">The ultimate marketplace for AI prompts. Share, discover, and monetize
                    your prompts.</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-400">Home</a></li>
                    <li><a href="{{ route('prompts.all') }}" class="hover:text-blue-400">Explore Prompts</a></li>
                    @auth
                        <li><a href="{{ route('my-prompts') }}" class="hover:text-blue-400">My Prompts</a></li>
                        <li><a href="{{ route('saved-prompts') }}" class="hover:text-blue-400">Saved Prompts</a></li>
                    @endauth
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h4 class="text-white font-semibold mb-4">Support</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-blue-400">FAQ</a></li>
                    <li><a href="#" class="hover:text-blue-400">Contact Us</a></li>
                    <li><a href="#" class="hover:text-blue-400">Report Issue</a></li>
                </ul>
            </div>

            <!-- Legal -->
            <div>
                <h4 class="text-white font-semibold mb-4">Legal</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-blue-400">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-blue-400">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-blue-400">Cookie Policy</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8">
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-400">© 2026 PromptHub. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="hover:text-blue-400"><svg class="w-5 h-5" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.667 10c0 .397-.119.774-.343 1.093l-2.52-2.52a1.674 1.674 0 1 1 2.863 1.427Z">
                            </path>
                        </svg></a>
                    <a href="#" class="hover:text-blue-400"><svg class="w-5 h-5" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Z"></path>
                        </svg></a>
                </div>
            </div>
        </div>
    </div>
</footer>
