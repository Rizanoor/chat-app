<template>
    <div class="items-center rounded-b-md py-5 px-5 bg-[#4B164C]">
        <div class="items-center py-4 px-1">
            <h1 class=" text-center text-white font-bold text-xl">Messages</h1>
        </div>
        <div class="mt-8 px-5">
            <h2 class="text-white text-lg mb-4">Recent Matches</h2>
            <div class="flex space-x-3 overflow-x-auto snap-x snap-mandatory scroll-smooth">
                <div class="relative snap-center group">
                    <img src="https://ui-avatars.com/api/?name=John" alt="match-1"
                        class="rounded-xl w-24 h-28 object-cover transition duration-300" />

                    <!-- Hover effect -->
                    <div
                        class="absolute inset-0 flex items-center justify-center bg-[#DD88CF] bg-opacity-60 rounded-xl opacity-0 group-hover:opacity-100 transition duration-300">
                        <i class="fa-solid fa-heart text-white text-lg"></i>
                        <span class="text-white font-bold ml-1">32</span>
                    </div>
                </div>
                <div class="relative snap-center group">
                    <img src="https://ui-avatars.com/api/?name=Jane" alt="match-2"
                        class="rounded-xl w-24 h-28 object-cover transition duration-300" />

                    <!-- Hover effect -->
                    <div
                        class="absolute inset-0 flex items-center justify-center bg-[#DD88CF] bg-opacity-60 rounded-xl opacity-0 group-hover:opacity-100 transition duration-300">
                        <i class="fa-solid fa-heart text-white text-lg"></i>
                        <span class="text-white font-bold ml-1">15</span>
                    </div>
                </div>
                <div class="relative snap-center group">
                    <img src="https://ui-avatars.com/api/?name=Tom" alt="match-3"
                        class="rounded-xl w-24 h-28 object-cover transition duration-300" />

                    <!-- Hover effect -->
                    <div
                        class="absolute inset-0 flex items-center justify-center bg-[#DD88CF] bg-opacity-60 rounded-xl opacity-0 group-hover:opacity-100 transition duration-300">
                        <i class="fa-solid fa-heart text-white text-lg"></i>
                        <span class="text-white font-bold ml-1">20</span>
                    </div>
                </div>
                <div class="relative snap-center group">
                    <img src="https://ui-avatars.com/api/?name=Sarah" alt="match-4"
                        class="rounded-xl w-24 h-28 object-cover transition duration-300" />

                    <!-- Hover effect -->
                    <div
                        class="absolute inset-0 flex items-center justify-center bg-[#DD88CF] bg-opacity-60 rounded-xl opacity-0 group-hover:opacity-100 transition duration-300">
                        <i class="fa-solid fa-heart text-white text-lg"></i>
                        <span class="text-white font-bold ml-1">10</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 px-5">
            <span @click="setActiveChip('all')" 
                  :class="{'bg-[#DD88CF] text-white': activeChip === 'all', 'text-gray-700': activeChip !== 'all'}" 
                  class="inline-flex items-center justify-center px-3 py-1 rounded-full text-sm font-medium mr-2 cursor-pointer">
                All
            </span>
            <span @click="navigateToGroup" 
                  class="inline-flex items-center text-white justify-center px-3 py-1 mr-2  rounded-full border border-gray-300 text-sm font-medium cursor-pointer">
                Group
            </span>
            <span @click="navigateToNearby" 
                  class="inline-flex items-center text-white justify-center px-3 py-1 rounded-full border border-gray-300 text-sm font-medium cursor-pointer">
                Nearby
            </span>
        </div>
    </div>

    <div class="bg-white h-[520px]">
        <div class="overflow-y-auto h-full">
            <div class="flex justify-between items-center border-b py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-1"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">JASIMAN Calzoni</h3>
                        <p class="text-gray-500 text-sm">What about that new jacket if I ...</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">09:18</span>
                </div>
            </div>

            <div class="flex justify-between items-center border-b py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-2"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">Clara Hazel</h3>
                        <p class="text-gray-500 text-sm">I know right 😉</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">12:44</span>
                </div>
            </div>

            <div class="flex justify-between items-center border-b py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-3"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">Brandon Aminoff</h3>
                        <p class="text-gray-500 text-sm">I’ve already registered, can’t wait ...</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">08:06</span>
                </div>
            </div>
            <div class="flex justify-between items-center border-b py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-3"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">Brandon Aminoff</h3>
                        <p class="text-gray-500 text-sm">I’ve already registered, can’t wait ...</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">08:06</span>
                </div>
            </div>
            <div class="flex justify-between items-center border-b py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-3"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">Brandon Aminoff</h3>
                        <p class="text-gray-500 text-sm">I’ve already registered, can’t wait ...</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">08:06</span>
                </div>
            </div>
            <div class="flex justify-between items-center border-b py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-3"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">Brandon Aminoff</h3>
                        <p class="text-gray-500 text-sm">I’ve already registered, can’t wait ...</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">08:06</span>
                </div>
            </div>
            <div class="flex justify-between items-center border-b py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-3"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">Brandon Aminoff</h3>
                        <p class="text-gray-500 text-sm">I’ve already registered, can’t wait ...</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">08:06</span>
                </div>
            </div>
            <div class="flex justify-between items-center border-b py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-3"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">Brandon Aminoff</h3>
                        <p class="text-gray-500 text-sm">I’ve already registered, can’t wait ...</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">08:06</span>
                </div>
            </div>
            <div class="flex justify-between items-center border-b py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-3"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">Brandon Aminoff</h3>
                        <p class="text-gray-500 text-sm">I’ve already registered, can’t wait ...</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">08:06</span>
                </div>
            </div>

            <div class="flex justify-between items-center py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-4"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">Amina Mina</h3>
                        <p class="text-gray-500 text-sm">It will have two lines of heading ...</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">09:32</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
    users: [Array, Object],
    loggedInUser: Object,
});

const isDropdownOpen = ref(false);

const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};

const closeDropdown = (event) => {
    if (!event.target.closest('.relative')) {
        isDropdownOpen.value = false;
    }
};
const isSender = (senderId) => {
    return props.loggedInUser.id === senderId;
};

const activeChip = ref('all');
const setActiveChip = (chip) => {
    activeChip.value = chip;
};

const navigateToGroup = () => {
    window.location.href = '/groups';
}

const navigateToStatus = () => {
    window.location.href = '/status';
}
const navigateToNearby = () => {
    window.location.href = '/find-partner';
}

onMounted(() => {
    document.addEventListener('click', closeDropdown);

    const loggedInUserId = props.loggedInUser.id;

    Echo.private(`dashboard.${loggedInUserId}`)
        .listen('MessageSent', (response) => {
            const user = props.users.find(u => u.id === response.message.sender_id);
            if (user) {
                user.lastMessage = response.message;
                user.unreadCount += 1;
            }
        })
});

onBeforeUnmount(() => {
    document.removeEventListener('click', closeDropdown);
});

const formatTime = (time) => {
    return new Date(time).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
};
</script>