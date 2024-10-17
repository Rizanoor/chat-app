<x-app-layout>
    <div class="bg-white overflow-hidden sm:rounded-lg mt-6">
        <div class="p-6 text-gray-900">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-700">Contacts</h2>
                <div class="flex items-center relative">
                    <!-- Avatar dan Nama -->
                    <p class="text-md text-gray-600">
                        <span class="font-normal text-gray-700"> Hi, {{ Auth::user()->name }}</span>
                    </p>
                    <!-- Avatar Dropdown -->
                    <details class="relative ml-3 z-10">
                        <summary class="list-none cursor-pointer">
                            <img src="{{ asset('img/avatar.jpg') }}" alt="Avatar" class="w-10 h-10 rounded-full">
                        </summary>
                        <!-- Dropdown -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg border">
                            <ul>
                                <li>
                                    <a href={{ route('profile.edit') }}
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="block px-4 py-2 bg-red-500 text-white hover:bg-red-600"
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            Logout
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </details>
                </div>
            </div>

            <!-- Scrollable Chat List -->
            <div class="h-[645px] overflow-y-auto">
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-4">
                    <a href="{{ route('contact') }}"
                        class="bg-gray-100 p-4 rounded-lg block hover:bg-gray-200 relative">
                        <div class="flex items-left">
                            <p class="text-lg font-semibold">
                               + Create Contact
                            </p>
                        </div>
                    </a>
                    @foreach ($users as $user)
                        <a href="{{ route('chat', $user->id) }}"
                            class="bg-gray-100 p-4 rounded-lg block hover:bg-gray-200 relative">
                            <div class="flex items-center">
                                <!-- User Avatar -->
                                <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random&color=fff"
                                    alt="{{ $user->name }}" class="w-8 h-8 rounded-full mr-3">
                                <h3 class="text-lg font-normal">
                                    {{ $user->name }}
                                </h3>
                            </div>
                        </a>
                    @endforeach
                    <div class="fixed bottom-36 right-52 z-10">
                        <a href="{{route('dashboard')}}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full border">
                            Back
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
