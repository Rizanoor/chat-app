<x-app-layout>
    <div class="bg-[#FDF7FD] overflow-hidden shadow-sm rounded-lg mt-6">
        <div class="p-6">
            <chat-component :user="{{ $user }}" :current-user="{{ auth()->user() }}"></chat-component>
        </div>
    </div>
</x-app-layout>
