<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">
    <!-- Primary Navigation Menu -->
    <div class="max-w-lg mx-auto px-4 sm:px-6">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0">
                    <a href="{{ route('dashboard') }}"
                        class="text-xl font-bold text-gray-600 hover:text-gray-800 transition duration-300">
                        Citchat
                    </a>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-4 sm:flex items-center">
                <form method="POST" action="{{ route('logout') }}" class="flex items-center">
                    @csrf
                    <a class="px-4 py-2 text-sm bg-red-500 font-semibold text-white rounded hover:bg-blue-100 hover:text-blue-600 transition duration-300 ease-in-out"
                        href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        Logout
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
