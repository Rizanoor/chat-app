<template>
    <div class="flex flex-col h-[500px]">
      <div class="flex items-center">
        <h1 class="text-lg font-semibold mr-2">{{ user.name }}</h1>
        <span :class="isUserOnline ? 'bg-green-500' : 'bg-gray-400'" class="inline-block h-2 w-2 rounded-full"></span>
      </div>
  
      <!-- Messages -->
      <div ref="messageContainer" class="overflow-y-auto p-4 mt-3 flex-grow border-t border-gray-200">
        <div class="space-y-4">
          <div
            v-for="message in messages"
            :key="message.id"
            :class="{ 'text-right': message.sender_id === currentUser.id }"
            class="mb-4"
          >
            <div
              :class="message.sender_id === currentUser.id ? 'bg-indigo-500 ' : 'bg-gray-200 text-gray-800'"
              class="inline-block px-5 py-2 rounded-lg"
            >
              <p>{{ message.text }}</p>
              <span class="text-[10px]">{{ formatTime(message.created_at) }}</span>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Message Input -->
      <div class="border-t pt-4">
        <form @submit.prevent="sendMessage">
          <div class="flex items-center">
            <input
              v-model="newMessage"
              @keydown="debounceTyping"
              type="text"
              class="flex-1 border p-3 rounded-lg"
              placeholder="Type your message here..."
            />
            <button type="submit" class="ml-2 bg-indigo-500 text-white p-3 rounded-lg shadow hover:bg-indigo-600 transition duration-300 flex items-center justify-center">
              <i class="fas fa-paper-plane"></i>
              <span class="ml-2">Send</span>
            </button>
          </div>
        </form>
      </div>
  
      <small v-if="isUserTyping" class="text-gray-600 mt-5">
        {{ user.name }} is typing...
      </small>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted, watch, nextTick } from 'vue';
  import axios from 'axios';
  import { debounce } from 'lodash'; // Import lodash for debouncing
  
  const csrfToken = document.head.querySelector('meta[name="csrf-token"]');
  axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken.content;

  const props = defineProps({
    user: {
      type: Object,
      required: true,
    },
    currentUser: {
      type: Object,
      required: true,
    },
  });
  
  const messages = ref([]);
  const newMessage = ref('');
  const messageContainer = ref(null);
  const isUserTyping = ref(false);
  const isUserTypingTimer = ref(null);
  const isUserOnline = ref(false);
  
  watch(messages, () => {
    nextTick(() => {
      messageContainer.value.scrollTo({
        top: messageContainer.value.scrollHeight,
        behavior: 'smooth',
      });
    });
  }, { deep: true });
  
  const fetchMessages = async () => {
    try {
      const response = await axios.get(`/messages/${props.user.id}`);
      console.log('halo'.response);
      
      messages.value = response.data;
    } catch (error) {
      console.error('Failed to fetch messages:', error);
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
      } catch (error) {
        console.error('Failed to send message:', error);
      }
    }
  };
  
//   // Debounce typing event to avoid sending too many requests
//   const debounceTyping = debounce(() => {
//     sendTypingEvent();
//   }, 300); // Adjust the debounce time as needed
  
//   const sendTypingEvent = () => {
//     Echo.private(`chat.${props.user.id}`).whisper('typing', {
//       userID: props.currentUser.id,
//     });
//   };
  
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
      .listen('MessageSent', (response) => {
        messages.value.push(response.message);
      })
      .listenForWhisper('typing', (response) => {
        isUserTyping.value = response.userID === props.user.id;
  
        if (isUserTypingTimer.value) {
          clearTimeout(isUserTypingTimer.value);
        }
  
        isUserTypingTimer.value = setTimeout(() => {
          isUserTyping.value = false;
        }, 1000);
      });
  });
  </script>
  