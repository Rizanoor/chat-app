<template>
    <div class="flex flex-col h-[700px]">
        <div ref="contactContainer" class="overflow-y-auto p-4 flex-grow">
            <div class="space-y-4">
                <div class="flex">
                    <a href="/dashboard" class="mr-3 text-gray-800 px-3 py-2 rounded-lg shadow-sm bg-gray-100 hover:bg-gray-300 transition duration-300">
                        ◀️
                    </a>
                    <button @click="showModal = true" class="bg-blue-500 text-white p-2 rounded-lg block text-sm hover:bg-blue-600 transition w-full">
                        + New Contact
                    </button>
                </div>

                <!-- Modal -->
                <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
                    <div class="bg-white rounded-lg p-6 shadow-lg w-full max-w-md">
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
                <!-- Contact List -->
                <div v-for="contact in user" :key="contact.id" class="bg-gray-100 p-4 rounded-lg transition hover:bg-gray-200">
                    <a :href="`/chat/${contact.id}`" class="block">
                        <div class="flex items-center">
                            <img :src="`https://ui-avatars.com/api/?name=${contact.name}&background=random&color=fff`"
                                :alt="contact.name" class="w-8 h-8 rounded-full mr-3">
                            <div>
                                <h3 class="text-lg font-semibold">{{ contact.name }}</h3>
                                <p class="text-sm text-gray-600">{{ contact.email }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    user: Array,
    currentUser: Object
});

const showModal = ref(false);

const contact = ref({
    name: '',
    email: ''
});

const submitForm = () => {
    showModal.value = false;
    contact.value.name = '';
    contact.value.email = '';
};
</script>

