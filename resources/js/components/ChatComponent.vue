<template>
    <div class="flex flex-col h-[500px]">
        <div class="flex items-center">
            <h1 class="text-lg font-semibold mr-2">{{ user.name }}</h1>
            <span :class="isUserOnline ? 'bg-green-500' : 'bg-gray-400'"
                class="inline-block h-2 w-2 rounded-full"></span>

        </div>

        <!-- Messages -->
        <div ref="messageContainer" class="overflow-y-auto p-4 mt-3 flex-grow border-t border-gray-200">
            <div class="space-y-4">
                <div v-for="message in messages" :key="message.id"
                    :class="{ 'text-right': message.sender_id === currentUser.id }" class="mb-4">
                    <div :class="message.sender_id === currentUser.id ? 'bg-indigo-500 text-white' : 'bg-gray-200 text-gray-800'"
                        class="inline-block px-5 py-2 rounded-lg">
                        <p>{{ message.text }}</p>
                        <div class="flex items-center space-x-2 text-[10px] mt-1">
                            <!-- Display message status for the sender -->
                            <div v-if="message.sender_id === currentUser.id" class="flex items-center space-x-1">
                                <span v-if="message.is_read" class="text-green-500">Read</span>
                                <span v-else-if="message.is_delivered" class="text-yellow-500">Delivered</span>
                                <span v-else class="text-red-400">Sending...</span>
                            </div>
                            
                            <!-- Display message timestamp -->
                            <span>{{ formatTime(message.created_at) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message Input -->
        <div class="border-t pt-4">
            <form @submit.prevent="sendMessage">
                <div class="flex items-center">
                    <input v-model="newMessage" @keydown="sendTypingEvent" type="text"
                        class="flex-1 border p-3 rounded-lg" placeholder="Type your message here..." />
                    <button type="submit"
                        class="ml-2 bg-indigo-500 text-white p-3 rounded-lg shadow hover:bg-indigo-600 transition duration-300 flex items-center justify-center">
                        Send
                    </button>
                </div>
            </form>
        </div>
    </div>
    <small v-if="isUserTyping" class="text-gray-600 mt-5">
        {{ user.name }} is typing...
    </small>
</template>


<script setup>
import { ref, onMounted, watch, nextTick } from 'vue';
import axios from 'axios';

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    currentUser: {
        type: Object,
        required: true
    }
});

const messages = ref([]);
const newMessage = ref('');
const messageContainer = ref(null)
const isUserTyping = ref(false);
const isUserTypingTimer = ref(null);
const isUserOnline = ref(false);

watch(
    messages,
    () => {
        nextTick(() => {
            messageContainer.value.scrollTo({
                top: messageContainer.value.scrollHeight,
                behavior: "smooth",
            });
        });
    },
    { deep: true }
);

const fetchMessages = async () => {
    try {
        const response = await axios.get(`/messages/${props.user.id}`);
        messages.value = response.data;

        // Tandai pesan terakhir sebagai dibaca
        if (messages.value.length > 0) {
            markMessagesAsRead(messages.value[messages.value.length - 1].id);
        }
    } catch (error) {
        console.error("Failed to fetch messages:", error);
    }
};

const markMessagesAsRead = async (messageId) => {
    try {
        await axios.post(`/messages/read/${messageId}`);
    } catch (error) {
        console.error("Failed to mark message as read:", error);
    }
};

const sendMessage = async () => {
    if (newMessage.value.trim() !== '') {
        try {
            const response = await axios.post(`/messages/${props.user.id}`, {
                message: newMessage.value,
            });
            messages.value.push(response.data);
            newMessage.value = '';

            // Tandai pesan terbaru sebagai dibaca setelah mengirim
            markMessagesAsRead(response.data.id);
        } catch (error) {
            console.error("Failed to send message:", error);
        }
    }
};

const sendTypingEvent = () => {
    Echo.private(`chat.${props.user.id}`).whisper("typing", {
        userID: props.currentUser.id,
    });

    // Tandai pesan terakhir sebagai dibaca saat mulai mengetik
    if (messages.value.length > 0) {
        markMessagesAsRead(messages.value[messages.value.length - 1].id);
    }
};

const formatTime = (datetime) => {
    const options = { hour: '2-digit', minute: '2-digit' };
    return new Date(datetime).toLocaleTimeString([], options);
};

onMounted(() => {
    fetchMessages();

    Echo.join(`presence.chat`)
        .here(users => {
            isUserOnline.value = users.some(user => user.id === props.user.id);
        })
        .joining(user => {
            if (user.id === props.user.id) isUserOnline.value = true;
        })
        .leaving(user => {
            if (user.id === props.user.id) isUserOnline.value = false;
        });

    Echo.private(`chat.${props.currentUser.id}`)
        .listen("MessageSent", (response) => {
            messages.value.push(response.message);
        })
        .listenForWhisper("typing", (response) => {
            isUserTyping.value = response.userID === props.user.id;

            if (isUserTypingTimer.value) {
                clearTimeout(isUserTypingTimer.value);
            }

            isUserTypingTimer.value = setTimeout(() => {
                isUserTyping.value = false;
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
</script>