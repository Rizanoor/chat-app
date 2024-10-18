<template>
    <div class="flex flex-col h-full w-full">
        <div ref="contactContainer" class="overflow-y-auto flex-grow no-scrollbar">
            <div class="space-y-4">
                <div class="flex">
                    <a href="/dashboard"
                        class="mr-3 text-gray-800 px-3 py-2 rounded-full border hover:bg-gray-300 transition duration-300">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <button @click="openModal" 
                        class="bg-green-500 text-white p-2 rounded-lg block text-sm hover:bg-green-600 transition w-full">
                        + New Group
                    </button>
                </div>

                <!-- Group List -->
                <div v-for="group in groups" :key="group.id"
                    class="border-b p-4 rounded-lg hover:bg-gray-200 transition">
                    <a :href="`/groups/${group.id}`" class="block">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-3">
                                <img :src="`https://ui-avatars.com/api/?name=${group.name}&background=random&color=fff`"
                                    :alt="group.name" class="w-12 h-12 rounded-full border border-gray-300" />
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">{{ group.name }}</h3>
                                    <p class="text-sm text-gray-600">{{ group.users.length }} anggota</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Modal New Group -->
                <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white p-6 rounded-lg w-1/2">
                        <h2 class="text-lg font-semibold mb-4">New Group</h2>

                        <form @submit.prevent="createGroup">
                            <input v-model="groupName" type="text" placeholder="Group Name"
                                class="w-full border rounded-lg p-2 mb-4" required />

                            <h3 class="text-md font-medium mb-2">Invite Users</h3>
                            <div class="max-h-40 overflow-y-auto border p-2 rounded-md">
                                <div v-for="user in users" :key="user.id" class="flex items-center mb-2">
                                    <input 
                                        type="checkbox" 
                                        :value="user.id" 
                                        v-model="invitedUsers" 
                                        :checked="user.id === loggedInUserId.id" 
                                        class="mr-2" 
                                    />
                                    <span>{{ user.name }}</span>
                                </div>
                            </div>

                            <div class="flex justify-end space-x-2 mt-4">
                                <button type="button" @click="showModal = false"
                                    class="bg-gray-500 text-white px-4 py-2 rounded-lg">
                                    Cancel
                                </button>
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                                    Create Group
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Toast Notification -->
        <div v-if="showToast" class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg">
            {{ toastMessage }}
        </div>
    </div>
</template>



<script setup>
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    groups: Array,
    users: Array,
    loggedInUserId: Number,
});

const showModal = ref(false);
const showToast = ref(false);
const groupName = ref('');
const invitedUsers = ref([]);
const toastMessage = ref('');

const showToastNotification = (message) => {
    toastMessage.value = message;
    showToast.value = true;

    setTimeout(() => {
        showToast.value = false;
    }, 3000);
};

const openModal = () => {
    showModal.value = true;
    invitedUsers.value = [props.loggedInUserId];
};

const createGroup = async () => {
    try {
        await axios.post('/groups', {
            name: groupName.value,
            user_ids: invitedUsers.value,
        });

        showToastNotification('Contact created successfully!');
        showModal.value = false;
        groupName.value = '';
        invitedUsers.value = [];
    } catch (error) {
        console.error(error.response?.data?.errors || error.message);
        showToastNotification('An error occurred while creating the contact.');
    }
};
</script>

<style scoped>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>