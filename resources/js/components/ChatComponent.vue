<template>
    <div class="flex flex-col h-[800px]">
        <div class="flex items-center">
            <a href="/dashboard"
                class="mr-3 text-gray-800 px-3 py-2 rounded-full hover:bg-gray-300 transition duration-300">
                <i class="fas fa-arrow-left"></i>
            </a>
            <img :src="'https://i.pravatar.cc/100'" alt="avatar"
                class="w-12 h-12 rounded-full mr-3">

            <h1 class="text-lg font-semibold mr-2">{{ user.name }}</h1>
            <span :class="isUserOnline ? 'bg-green-500' : 'bg-gray-400'"
                class="inline-block h-2 w-2 rounded-full"></span>

            <div class="ml-auto flex items-center">
                <a href="#"
                    class="mr-3 text-gray-800 px-3 py-2 rounded-full hover:bg-gray-300 transition duration-300">
                    <i class="fa-solid fa-phone"></i>
                </a>
                <a href="#"
                    class="text-gray-800 px-3 py-2 rounded-full hover:bg-gray-300 transition duration-300">
                    <i class="fa-solid fa-video"></i>
                </a>
            </div>
        </div>


        <!-- Messages -->
        <div ref="messageContainer" class="overflow-y-auto p-4 mt-3 flex-grow border-t border-gray-200">
            <div class="space-y-4">
                <div v-for="message in messages" :key="message.id"
                    :class="{ 'text-right': message.sender_id === currentUser.id }" class="mb-4"
                    @click="setReplyToMessage(message)">

                    <!-- Display reply if available -->
                    <div v-if="message.reply_to && message.repliedTo"
                        class="ml-4 mb-1 bg-gray-100 p-2 rounded-md shadow-sm">
                        <p class="text-sm text-gray-600"><strong>Balasan dari {{ message.repliedTo.sender.name
                                }}:</strong> {{ message.repliedTo.text }}</p>
                    </div>

                    <div :class="message.sender_id === currentUser.id ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-800'"
                        class="inline-block px-5 py-2 rounded-lg transition-all duration-300 hover:shadow-lg max-w-[350px]">
                        <p v-html="formatMessage(message.text)"></p>
                        <div class="flex items-center space-x-2 text-[10px] mt-1">
                            <div v-if="message.sender_id === currentUser.id" class="flex items-center space-x-1">
                                <span v-if="message.is_read" class="items-left rounded-sm bg-red-100 px-1 text-[10px] text-red-700">R</span>
                                <span v-else-if="message.is_delivered" class="items-left rounded-sm bg-blue-100 px-1 text-[10px] text-blue-700">D</span>
                                
                                <span v-else class="text-red-400">Sending...</span>
                            </div>
                            <span>{{ formatTime(message.created_at) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message Input -->
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
                <small v-if="replyToMessageId" class="mt-2 text-gray-600">
                    Balas ke: <strong>{{ messages.find(m => m.id === replyToMessageId).text }}</strong>
                </small>
            </form>
        </div>
    </div>
    <small v-if="isUserTyping" class="text-gray-600 mt-5">
        {{ user.name }} sedang mengetik...
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
const replyToMessageId = ref(null);
const messageContainer = ref(null);
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

const formatMessage = (text) => {
    return text.replace(/\n/g, '<br>');
};

const fetchMessages = async () => {
    try {
        const response = await axios.get(`/messages/${props.user.id}`);
        messages.value = response.data;

        // Mark the last message as read
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
                reply_to: replyToMessageId.value // Include the reply_to in the request
            });
            messages.value.push(response.data);
            newMessage.value = '';
            replyToMessageId.value = null; // Reset the reply after sending
            markMessagesAsRead(response.data.id);
        } catch (error) {
            console.error("Failed to send message:", error);
        }
    }
};

// Function to set which message to reply to
const setReplyToMessage = (message) => {
    newMessage.value = `@${message.sender.name}\n${message.text}\n\n`;
    replyToMessageId.value = message.id;
};

const sendTypingEvent = () => {
    Echo.private(`chat.${props.currentUser.id}`).whisper("typing", {
        userID: props.currentUser.id,
    });

    // Mark the last message as read while typing
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

<style scoped>
.hover\:shadow-lg:hover {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}
</style>
