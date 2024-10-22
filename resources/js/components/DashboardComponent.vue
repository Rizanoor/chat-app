<template>
    <div>
        <!-- Search Input dan Ellipsis -->
        <div class="mb-2 flex items-center space-x-3 relative">
            <input type="text" id="search" name="search" placeholder="Search contacts..."
                class="w-full border border-gray-200 bg-gray-50 rounded-lg py-2 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button @click="toggleDropdown" class="flex-shrink-0 font-extrabold transition focus:outline-none">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>

            <div v-if="isDropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                <div class="py-1">
                    <a href="/contact" class="block px-4 py-2 text-gray-800 hover:bg-gray-200"><i
                            class="fa-solid fa-address-book mr-2"></i>Contact</a>
                    <hr>
                    <a href="/groups" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">
                        <i class="fa-solid fa-users mr-2"></i>Groups</a>
                    <hr>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200"><i
                            class="fa-solid fa-film mr-2"></i> Status</a>
                </div>
            </div>
        </div>

        <!-- Chip Component -->
        <div class="mt-4">
            <span @click="setActiveChip('all')" 
                  :class="{'bg-green-500 text-white': activeChip === 'all', 'text-gray-700': activeChip !== 'all'}" 
                  class="inline-flex items-center justify-center px-3 py-1 rounded-full text-sm font-medium mr-2 cursor-pointer">
                All
            </span>
            <span @click="navigateToGroup" 
                  class="inline-flex items-center justify-center px-3 py-1 mr-2  rounded-full border border-gray-300 text-sm font-medium cursor-pointer">
                Group
            </span>
            <span @click="navigateToStatus" 
                  class="inline-flex items-center justify-center px-3 py-1 mr-2 rounded-full border border-gray-300 text-sm font-medium cursor-pointer">
                Status
            </span>
            <span @click="navigateToNearby" 
                  class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-gray-300 text-sm font-medium cursor-pointer">
                Nearby
            </span>
        </div>

        <!-- Scrollable Chat List -->
        <div class="h-[645px] overflow-y-auto rounded-lg">
            <div class="grid grid-cols-1 gap-1 mt-4">
                <a v-for="user in users" :key="user.id" :href="`/chat/${user.id}`"
                    class="bg-white p-4 block hover:bg-gray-100 border-b rounded-lg transition relative">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img :src="`https://ui-avatars.com/api/?name=${user.name}&background=random&color=fff`"
                                :alt="user.name" class="w-12 h-12 rounded-full border border-gray-300 mr-3">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ user.name }}</h3>
                                <p class="text-sm text-gray-600">
                                    <template v-if="user.lastMessage && isSender(user.lastMessage.sender_id)">
                                        <span v-if="user.lastMessage.is_read"
                                            class="inline-flex items-center rounded-md bg-green-50 px-2 text-[0.5rem] font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                            R
                                        </span>
                                        <span v-else
                                            class="inline-flex items-center rounded-md bg-yellow-50 px-2 text-[0.5rem] font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">
                                            D
                                        </span>
                                        &nbsp;
                                    </template>
                                    {{ user.lastMessage ? user.lastMessage.text.slice(0, 50) : 'Belum ada pesan' }}
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-gray-400 text-xs">
                                {{ formatTime(user.lastMessage.created_at) }}
                            </span>
                            <div v-if="user.unreadCount > 0" class="mt-1">
                                <span class="bg-green-500 text-white text-xs rounded-full px-3 py-1">
                                    {{ user.unreadCount }}
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
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

<style scoped>
/* Styling tambahan jika diperlukan */
</style>
