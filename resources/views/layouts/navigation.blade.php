<nav class="bg-white dark:bg-gray-800 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <span class="text-2xl font-bold text-blue-600">PromptHub</span>
                </a>
            </div>

            <!-- Center Menu -->
            <div class="hidden md:flex md:items-center md:space-x-8">
                <a href="{{ route('home') }}"
                    class="text-gray-700 dark:text-gray-300 hover:text-blue-600 @if (Route::currentRouteName() === 'home') text-blue-600 font-semibold @endif">Home</a>
                <a href="{{ route('prompts.all') }}"
                    class="text-gray-700 dark:text-gray-300 hover:text-blue-600 @if (Route::currentRouteName() === 'prompts.all') text-blue-600 font-semibold @endif">All
                    Prompts</a>
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="text-gray-700 dark:text-gray-300 hover:text-blue-600 @if (Route::currentRouteName() === 'dashboard') text-blue-600 font-semibold @endif">Dashboard</a>
                @endauth
            </div>

            <!-- Right Menu -->
            <div class="flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}"
                        class="text-gray-700 dark:text-gray-300 hover:text-blue-600 font-medium">Login</a>
                    <a href="{{ route('register') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-medium">Sign Up</a>
                @else
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-gray-700 dark:text-gray-300 hover:text-blue-600">
                            <img src="{{ auth()->user()->photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                                alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full">
                            <span class="hidden md:inline">{{ auth()->user()->name }}</span>
                        </button>
                        <div
                            class="hidden group-hover:block absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-lg shadow-lg z-50">
                            <a href="{{ route('profile') }}"
                                class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">Profile</a>
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}"
                                    class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">Admin
                                    Panel</a>
                            @elseif(auth()->user()->role === 'creator')
                                <a href="{{ route('creator.dashboard') }}"
                                    class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">Creator
                                    Dashboard</a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">Logout</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-blue-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
