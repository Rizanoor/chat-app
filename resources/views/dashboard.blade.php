<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($users as $user)
                            <a href="{{ route('chat', $user->id) }}"
                                class="bg-gray-100 p-4 rounded-lg border block hover:bg-gray-200 relative">
                                <h3 class="text-lg font-semibold">{{ $user->name }}</h3>

                                @if ($user->unreadCount > 0)
                                    <span
                                        class="absolute top-2 right-2 bg-red-500 text-white text-xs rounded-full px-2">
                                        {{ $user->unreadCount }}
                                    </span>
                                @endif

                                @if ($user->lastMessage)
                                    <p class="text-gray-600 relative group">
                                        <span class="truncate max-w-[250px] inline-block"
                                            title="{{ $user->lastMessage->text }}">
                                            <strong>message:</strong>
                                            {{ $user->lastMessage->text }}
                                        </span>
                                        <div class="flex items-center mt-1">
                                            <span
                                                class="absolute left-0 z-10 hidden group-hover:block bg-white border border-gray-300 p-2 rounded-md shadow-md text-black">
                                                {{ $user->lastMessage->text }}
                                            </span>
                                            <span
                                                class="text-gray-400 text-sm">{{ \Carbon\Carbon::parse($user->lastMessage->created_at)->diffForHumans() }}
                                            </span>
                                        </div>
                                    </p>
                                @else
                                    <p class="text-gray-600">No messages yet.</p>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
