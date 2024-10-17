<x-app-layout>
    <div class="bg-white overflow-hidden sm:rounded-lg mt-6">
        <div class="p-6 text-gray-900">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-700">Chats</h2>
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
                    @foreach ($users as $user)
                        <a href="{{ route('chat', $user->id) }}"
                            class="bg-gray-100 p-4 rounded-lg block hover:bg-gray-200 relative">
                            <div class="flex items-center">
                                <!-- User Avatar -->
                                <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random&color=fff"
                                    alt="{{ $user->name }}" class="w-8 h-8 rounded-full mr-3">
                                <h3 class="text-lg font-semibold">
                                    {{ $user->name }}
                                    @if ($user->unreadCount > 0)
                                        <span class="bg-red-500 text-white text-xs rounded-full px-2">
                                            {{ $user->unreadCount }}
                                        </span>
                                    @endif
                                </h3>
                            </div>

                            @if ($user->lastMessage)
                                <p class="text-gray-600 relative group mt-2">
                                    <span class="truncate max-w-[450px] inline-block"
                                        title="{{ $user->lastMessage->text }}">
                                        {{ $user->lastMessage->text }}
                                        @if ($user->lastMessage->is_read)
                                            <span
                                                class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Read</span>
                                        @else
                                            <span
                                                class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Delivered</span>
                                        @endif
                                    </span>
                                <div class="flex items-center mt-1">
                                    <span
                                        class="absolute left-0 z-10 hidden group-hover:block bg-white border border-gray-300 p-2 rounded-md shadow-md text-black">
                                        {{ $user->lastMessage->text }}
                                    </span>
                                    <span
                                        class="text-gray-400 text-sm">{{ \Carbon\Carbon::parse($user->lastMessage->created_at)->diffForHumans() }}</span>
                                </div>
                                </p>
                            @else
                                <p class="text-gray-600">No messages yet.</p>
                            @endif
                        </a>
                    @endforeach
                    <div class="fixed bottom-36 right-52 z-10">
                        <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full border">
                            +
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
