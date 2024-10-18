<template>
    <div class="flex flex-col h-[800px]">
        <div class="flex items-center">
            <a href="/dashboard"
                class="mr-3 text-gray-800 px-3 py-2 rounded-full hover:bg-gray-300 transition duration-300">
                <i class="fas fa-arrow-left"></i>
            </a>

            <img :src="'https://ui-avatars.com/api/?name=' + group.name + '&background=random&color=fff'" 
                alt="avatar" class="w-12 h-12 rounded-full mr-3">

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
                    <!-- Nama Group -->
                    <input v-model="groupName" type="text" 
                        placeholder="Group Name" class="w-full border rounded-lg p-2 mb-4" required />

                    <!-- List User -->
                    <h3 class="text-md font-medium mb-2">Users in Group</h3>
                    <div class="max-h-40 overflow-y-auto border p-2 rounded-md">
                        <div v-for="user in users" :key="user.id" class="flex items-center mb-2">
                            <input type="checkbox" :value="user.id" v-model="selectedUsers" class="mr-2" />
                            <span>{{ user.name }}</span>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" @click="closeEditModal" 
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    group: {
        type: Object,
        required: true
    },
    users: {
        type: Array,
        required: true
    }
});

const showEditModal = ref(false);
const groupName = ref(props.group.name);
const selectedUsers = ref([...props.group.users.map(user => user.id)]);

const openEditModal = () => {
    showEditModal.value = true;
};

const closeEditModal = () => {
    showEditModal.value = false;
};

// const updateGroup = async () => {
//     try {
//         await axios.put(`/groups/${props.group.id}`, {
//             name: groupName.value,
//             user_ids: selectedUsers.value
//         });

//         alert('Group updated successfully!');
//         closeEditModal();
//         location.reload();
//     } catch (error) {
//         console.error('Error updating group:', error);
//         alert('Failed to update group.');
//     }
// };
</script>
