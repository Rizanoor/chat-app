<template>
    <div class="items-center rounded-b-md py-5 px-5">
        <!-- Header -->
        <div class="flex items-center py-2 px-2">
            <a href="/index"
                class="text-[#5E296B] border border-[#E4ACD4] rounded-full px-3 py-2 hover:bg-[#E4ACD4] transition ease-in-out duration-300">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="flex-1 text-center text-3xl font-bold text-[#5E296B]">Contacts</h1>
        </div>

        <!-- Stories Section -->
        <div class="flex space-x-4 px-4 overflow-x-auto mt-4">
            <button @click="showModal = true"
                class="bg-[#E4ACD4] text-white p-2 rounded-lg block text-sm hover:bg-[#ea95d2] transition w-full">
                + New Contact
            </button>
        </div>
        <!-- Modal -->
        <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="bg-[#FDF7FD] rounded-lg p-6 shadow-lg w-full max-w-md">
                <h2 class="text-2xl font-bold mb-4">Create New Contact</h2>
                <form @submit.prevent="submitForm">
                    <!-- Form Fields -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold">Name</label>
                        <input v-model="contact.name" type="text" id="name" name="name" required
                            class="w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-semibold">Email</label>
                        <input v-model="contact.email" type="email" id="email" name="email" required
                            class="w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition">Save</button>
                        <button type="button" @click="showModal = false"
                            class="ml-2 bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 transition">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="flex flex-col h-[66vh] overflow-y-auto px-6">
        <div v-for="contact in user" :key="contact.id" class="border-b p-4 rounded-lg transition hover:bg-gray-200">
            <a :href="`/chat/${contact.id}`" class="block">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img :src="`https://ui-avatars.com/api/?name=${contact.name}&background=random&color=fff`"
                            :alt="contact.name" class="w-12 h-12 rounded-full mr-3">
                        <div>
                            <h3 class="text-lg font-semibold">{{ contact.name }}</h3>
                            <p class="text-sm text-gray-600">{{ contact.email }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-gray-400 text-xs">
                            {{ contact.lastMessage ? formatDate(contact.lastMessage.created_at) : '' }}
                        </span>
                        <div v-if="contact.unreadCount > 0" class="mt-1">
                            <span class="bg-red-500 text-white text-xs rounded-full px-3 py-1">
                                {{ contact.unreadCount }}
                            </span>
                        </div>
                    </div>
                </div>
            </a>
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
    user: Array,
    currentUser: Object
});

const showModal = ref(false);
const showToast = ref(false);
const toastMessage = ref('');

const contact = ref({
    name: '',
    email: ''
});

const showToastNotification = (message) => {
    toastMessage.value = message;
    showToast.value = true;

    setTimeout(() => {
        showToast.value = false;
    }, 3000);
};

const submitForm = async () => {
    try {
        const response = await axios.post('/contacts', {
            name: contact.value.name,
            email: contact.value.email,
        });

        if (response.status === 201) {
            showToastNotification('Contact created successfully!');
            showModal.value = false;
            contact.value.name = '';
            contact.value.email = '';
        }
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
