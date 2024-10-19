<template>
    <div class="flex flex-col h-[800px]">
        <div class="flex items-center">
            <a href="/dashboard"
                class="mr-3 text-gray-800 px-3 py-2 rounded-full hover:bg-gray-300 transition duration-300">
                <i class="fas fa-arrow-left"></i>
            </a>

            <img :src="'https://ui-avatars.com/api/?name=' + group.name + '&background=random&color=fff'" alt="avatar"
                class="w-12 h-12 rounded-full mr-3">
            <h1 class="text-lg font-semibold mr-2">{{ group.name }}</h1>

            <div class="ml-auto flex items-center">
                <a href="#" @click="openEditModal"
                    class="mr-3 text-gray-800 px-3 py-2 rounded-full hover:bg-gray-300 transition duration-300">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
            </div>
        </div>

        <!-- Modal Edit Group -->
        <div v-if="showEditModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg w-1/2">
                <h2 class="text-lg font-semibold mb-4">Edit Group</h2>
                <form @submit.prevent="updateGroup">
                    <input v-model="groupName" type="text" placeholder="Group Name"
                        class="w-full border rounded-lg p-2 mb-4" required />
                    <h3 class="text-md font-medium mb-2">Users in Group</h3>
                    <div class="max-h-40 overflow-y-auto border p-2 rounded-md">
                        <div v-for="user in users" :key="user.id" class="flex items-center mb-2">
                            <input type="checkbox" :value="user.id" v-model="selectedUsers" class="mr-2" />
                            <span>{{ user.name }}</span>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" @click="closeEditModal"
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Messages -->
        <div ref="messageContainer" class="overflow-y-auto p-4 mt-3 flex-grow border-t border-gray-200">
            <div class="space-y-4">
                <div v-for="message in messages" :key="message.id" class="flex items-start mb-4"
                    :class="{ 'justify-end': message.sender_id === currentUser.id }">
                    <img v-if="message.sender_id !== currentUser.id"
                        :src="`https://ui-avatars.com/api/?name=${getUserNameById(message.sender_id)}&background=random&color=fff`"
                        :alt="getUserNameById(message.sender_id)"
                        class="w-8 h-8 rounded-full border border-gray-300 mr-3">

                    <div :class="message.sender_id === currentUser.id ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-800'"
                        class="inline-block px-4 py-2 rounded-lg transition-all duration-300 hover:shadow-lg max-w-[70%]">

                        <p class="font-semibold mb-1">{{ getUserNameById(message.sender_id) }}</p>
                        <p v-html="formatMessage(message.text)"></p>

                        <div class="flex text-[10px] mt-1"
                            :class="message.sender_id === currentUser.id ? 'text-white justify-end' : 'text-gray-800 justify-start'">
                            <span>{{ formatTime(message.created_at) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Messages Input -->
        <div class="pt-4">
            <form @submit.prevent="sendMessage">
                <div class="flex items-center">
                    <textarea v-model="newMessage" @keydown="sendTypingEvent"
                        class="flex-1 border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Ketik pesan Anda di sini..." rows="1" autofocus></textarea>
                    <button type="submit"
                        class="ml-2 bg-green-500 text-white p-4 rounded-lg shadow hover:bg-green-600 transition duration-300 flex items-center justify-center">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>

        <small v-if="isUserTyping" class="text-gray-600 mt-5">
            {{ typingUserName }} sedang mengetik...
        </small>
    </div>
</template>

<script setup>
import { ref, onMounted, watch, nextTick } from 'vue';
import axios from 'axios';

const props = defineProps({
    group: {
        type: Object,
        required: true
    },
    users: {
        type: Array,
        required: true
    },
    currentUser: {
        type: Object,
        required: true
    }
});

const messages = ref([...props.group.messages]);
const newMessage = ref('');
const showEditModal = ref(false);
const groupName = ref(props.group.name);
const selectedUsers = ref([...props.group.users.map(user => user.id)]);
const isUserTyping = ref(false);
const typingUserName = ref('');
let isUserTypingTimer = null;
const messageContainer = ref(null);

const scrollToBottom = () => {
    nextTick(() => {
        if (messageContainer.value) {
            messageContainer.value.scrollTo({
                top: messageContainer.value.scrollHeight,
                behavior: "smooth",
            });
        }
    });
};

const openEditModal = () => {
    showEditModal.value = true;
};

const closeEditModal = () => {
    showEditModal.value = false;
};

const formatMessage = (text) => {
    return text.replace(/\n/g, '<br>');
};

const formatTime = (datetime) => {
    const options = { hour: '2-digit', minute: '2-digit' };
    return new Date(datetime).toLocaleTimeString([], options);
};

const sendMessage = async () => {
    if (!newMessage.value.trim()) return;

    try {
        const response = await axios.post(`/groups/${props.group.id}/messages`, {
            text: newMessage.value,
        });

        messages.value.push(response.data);
        newMessage.value = '';
        scrollToBottom();
    } catch (error) {
        console.error('Error sending message:', error);
    }
};

const getUserNameById = (id) => {
    const user = props.users.find(user => user.id === id);
    return user ? user.name : 'Unknown';
};

const sendTypingEvent = () => {
    Echo.private(`group.${props.group.id}`).whisper('typing', {
        user: {
            id: props.currentUser.id,
            name: props.currentUser.name
        }
    });
};

onMounted(() => {
    scrollToBottom();

    Echo.channel(`chat.${props.group.id}`)
        .listen("MessageGroupSent", (response) => {
            if (response.message.sender_id !== props.currentUser.id) {
                messages.value.push(response.message);
                scrollToBottom();
            }
        })
        .listenForWhisper("typing", (response) => {
            isUserTyping.value = true;
            typingUserName.value = response.user.name;

            if (isUserTypingTimer) {
                clearTimeout(isUserTypingTimer);
            }

            isUserTypingTimer = setTimeout(() => {
                isUserTyping.value = false;
                typingUserName.value = '';
            }, 1000);
        })
        .listen('MessageDelivered', (response) => {
            const message = messages.value.find(m => m.id === response.message.id);
            if (message) {
                message.is_delivered = true;
            }
        })
        .listen('MessageRead', (response) => {
            const message = messages.value.find(m => m.id === response.message.id);
            if (message) {
                message.is_read = true;
            }
        });
});


const updateGroup = async () => {
    try {
        await axios.put(`/groups/${props.group.id}`, {
            name: groupName.value,
            user_ids: selectedUsers.value
        });

        alert('Group updated successfully!');
        closeEditModal();
        location.reload();
    } catch (error) {
        console.error('Error updating group:', error);
        alert('Failed to update group.');
    }
};
</script>
