<x-app-layout>
    <div class="bg-[#FDF7FD] overflow-hidden shadow-sm rounded-lg mt-6">
        <dashboard-component :logged-in-user="{{ json_encode(Auth::user()) }}" :users="{{ $users }}"></dashboard-component>
    </div>
</x-app-layout>
