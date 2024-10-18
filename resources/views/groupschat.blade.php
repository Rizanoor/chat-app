<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm rounded-lg mt-6">
        <div class="p-6">
            <groupschat-component :group="{{ $group }}" :users="{{ $allUsers }}"></groupschat-component>
        </div>
    </div>
</x-app-layout>
