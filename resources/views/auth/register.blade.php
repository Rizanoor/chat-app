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

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="flex flex-col items-center space-y-4">
                        <input type="text" id="name" name="name"
                            class="block mt-1 w-full border border-[#F3F3F3] rounded-full" required autofocus
                            autocomplete="username" placeholder="name">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />

                        <input type="email" id="email" name="email"
                            class="block mt-1 w-full border border-[#F3F3F3] rounded-full" required autofocus
                            autocomplete="username" placeholder="Email">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                        <input type="password" id="password" name="password"
                            class="block mt-1 w-full border border-[#F3F3F3] rounded-full" required autofocus
                            autocomplete="username" placeholder="Password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="block mt-1 w-full border border-[#F3F3F3] rounded-full" required autofocus
                            autocomplete="username" placeholder="Password Confirmation">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                        <button type="submit"
                            class="bg-[#FCF4FA] text-[#4B164C] px-6 py-3 rounded-full flex items-center justify-center space-x-3 w-64 hover:bg-purple-100 transition-colors duration-300">
                            <span class="font-medium">Register </span>
                        </button>
                    </div>
                </form>

                <!-- Signup link -->
                <p class="text-sm text-gray-600">
                    Alreagy have an account? <a href="{{ route('login') }}"
                        class="text-[#4B164C] font-semibold hover:underline">Sign In</a>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
