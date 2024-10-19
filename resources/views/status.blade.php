<x-app-layout>
    <div class="bg-white overflow-hidden sm:rounded-lg mt-6">
        <div class="p-6 text-gray-900">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Status</h2>
                <div class="flex items-center relative">
                    <!-- Avatar dan Nama -->
                    <p class="text-md text-gray-600 mr-1">
                        <span class="font-normal text-gray-800"> Hi, {{ Auth::user()->name }}</span>
                    </p>
                    <!-- Avatar Dropdown -->
                    <details class="relative ml-3 ">
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

            <div class="h-[690px] overflow-y-auto">
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-1">
                    <status-component></status-component>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
