<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm rounded-lg mt-6">
        <div class="p-6">
            <div class="flex flex-col items-center h-[800px] space-y-8 p-4">

                <!-- Circle of profile images -->
                <div class="relative w-450 h-500 rounded-full overflow-hidden bg-white">
                    <img src="{{ asset('img/Group.png') }}" alt="Center Profile" class="object-cover w-full h-full">
                </div>

                <!-- Heading text -->
                <h1 class="text-3xl font-semibold text-gray-800 text-center">
                    Let’s meet new people around you
                </h1>

                <!-- Login buttons -->
                <div class="flex flex-col items-center space-y-4">
                    <!-- Login with Phone -->
                    <a href="{{ route('login') }}"
                        class="bg-[#4B164C] text-white px-6 py-3 rounded-full flex items-center justify-center space-x-2 w-64 hover:bg-purple-800 transition-colors duration-300 shadow-lg">
                        Login
                    </a>

                    <button
                        class="bg-[#FCF4FA] text-[#4B164C] px-6 py-3 rounded-full flex items-center justify-center space-x-3 w-64 hover:bg-purple-100 transition-colors duration-300">
                        <img src="{{ asset('img/google.png') }}" alt="Google" class="w-6 h-6">

                        <span class="font-medium">Login with Google</span>
                    </button>
                </div>

                <!-- Signup link -->
                <p class="text-sm text-gray-600">
                    Don’t have an account? <a href="{{ route('register') }}"
                        class="text-[#4B164C] font-semibold hover:underline">Sign Up</a>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
