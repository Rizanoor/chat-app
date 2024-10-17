<x-app-layout>
    <div class="bg-white overflow-hidden sm:rounded-lg mt-6">
        <div class="p-6 text-gray-900">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Chats</h2>
                <div class="flex items-center">
                    <p class="text-md text-gray-600 mr-4">
                        <span class="font-normal text-gray-700">Hi, {{ Auth::user()->name }}</span>
                    </p>
                    <!-- Avatar Dropdown -->
                    <details class="relative">
                        <summary class="list-none cursor-pointer">
                            <img src="{{ asset('img/avatar.jpg') }}" alt="Avatar"
                                class="w-10 h-10 rounded-full border border-gray-300">
                        </summary>
                        <!-- Dropdown -->
                        <div
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                            <ul>
                                <li>
                                    <a href="{{ route('profile.edit') }}"
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

            <!-- Search Input -->
            <div class="mb-2 flex items-center space-x-3">
                <input type="text" id="search" name="search" placeholder="Search contacts..."
                    class="w-full border border-gray-200 bg-gray-50 rounded-lg py-2 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    v-model="searchTerm" @input="filterUsers">

                <a href="{{ route('contact') }}"
                    class="flex-shrink-0 font-extrabold transition">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </a>
            </div>

            <!-- Scrollable Chat List -->
            <div class="h-[645px] overflow-y-auto rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-4">
                    @foreach ($users as $user)
                        <a href="{{ route('chat', $user->id) }}"
                            class="bg-white p-4 block hover:bg-gray-100 border-b transition relative">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random&color=fff"
                                        alt="{{ $user->name }}"
                                        class="w-12 h-12 rounded-full border border-gray-300 mr-3">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h3>
                                        <p class="text-sm text-gray-600">
                                            @if ($user->lastMessage->is_read)
                                                <span
                                                    class="inline-flex items-center rounded-md bg-green-50 px-2 text-[0.5rem] font-medium text-green-700 ring-1 ring-inset ring-green-600/20">R</span>
                                            @else
                                                <span
                                                    class="inline-flex items-center rounded-md bg-yellow-50 px-2 text-[0.5rem] font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">D</span>
                                            @endif
                                            &nbsp;
                                            {{ $user->lastMessage ? Str::limit($user->lastMessage->text, 50) : 'No messages yet' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-gray-400 text-xs">
                                        {{ \Carbon\Carbon::parse($user->lastMessage->created_at)->format('h:i A') }}
                                    </span>
                                    @if ($user->unreadCount > 0)
                                        <div class="mt-1">
                                            <span class="bg-green-500 text-white text-xs rounded-full px-3 py-1">
                                                {{ $user->unreadCount }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
