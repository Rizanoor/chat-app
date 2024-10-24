<template>
    <div class="items-center rounded-b-md py-5 px-5">
        <!-- Header -->
        <div class="flex justify-between items-center py-2 px-2">
            <h1 class="text-3xl font-bold text-[#5E296B]">Friendzy</h1>
            <button
                class="text-[#5E296B] border border-[#E4ACD4] rounded-full px-3 py-2 hover:bg-[#E4ACD4] transition ease-in-out duration-300">
                <i class="fas fa-bell fa-lg"></i>
            </button>
        </div>

        <!-- Stories Section -->
        <div class="flex space-x-4 px-4 overflow-x-auto mt-4">
            <div class="flex flex-col items-center">
                <div class="relative">
                    <img src="https://i.pravatar.cc/100" alt="My Story"
                        class="rounded-full w-20 h-15 border-4 border-red-300">
                    <span
                        class="absolute bottom-0 right-0 w-6 h-6 bg-[#E4ACD4] rounded-full flex items-center justify-center">
                        <i class="fas fa-plus text-white"></i>
                    </span>
                </div>
                <p class="text-sm mt-2 text-center text-gray-800">My Story</p>
            </div>
            <div class="flex flex-col items-center">
                <img src="https://i.pravatar.cc/100?img=1" alt="Selena"
                    class="rounded-full w-20 h-15 border-4 border-[#E4ACD4]">
                <p class="text-sm mt-2 text-center text-gray-800">Selena</p>
            </div>
            <div class="flex flex-col items-center">
                <img src="https://i.pravatar.cc/100?img=2" alt="Clara"
                    class="rounded-full w-20 h-15 border-4 border-[#E4ACD4]">
                <p class="text-sm mt-2 text-center text-gray-800">Clara</p>
            </div>
            <div class="flex flex-col items-center">
                <img src="https://i.pravatar.cc/100?img=3" alt="Fabian"
                    class="rounded-full w-20 h-15 border-4 border-[#E4ACD4]">
                <p class="text-sm mt-2 text-center text-gray-800">Fabian</p>
            </div>
            <div class="flex flex-col items-center">
                <img src="https://i.pravatar.cc/100?img=4" alt="Gwen"
                    class="rounded-full w-20 h-15 border-4 border-[#E4ACD4]">
                <p class="text-sm mt-2 text-center text-gray-800">Gwen</p>
            </div>
        </div>
    </div>

    <div class="flex flex-col h-[66vh] overflow-y-auto px-6">
        <div class="flex justify-center mb-2">
            <div class="bg-[#f4e1f7] px-1 py-1 rounded-full">
                <div class="flex space-x-0">
                    <button
                        class="bg-white text-[#5E296B] font-bold py-2 px-6 rounded-l-full shadow-md hover:bg-[#E4ACD4] transition duration-300">
                        Make Friends
                    </button>
                    <button @click="navigateToFind"
                        class="bg-[#f4e1f7] text-[#5E296B] font-bold py-2 px-6 rounded-r-full border border-transparent hover:bg-[#E4ACD4] transition duration-300">
                        Search Partners
                    </button>
                </div>
            </div>
        </div>


        <div class="overflow-y-auto">
            <div class="flex justify-center items-center px-4 py-6">
                <div class="w-full bg-white rounded-xl border overflow-hidden transform transition duration-500">
                    <div class="relative">
                        <img class="w-full h-64 object-cover"
                            src="https://images.unsplash.com/photo-1540206395-68808572332f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                            alt="Nature scene">
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900">If you could live anywhere in the world, where would
                            you pick?</h2>
                        <!-- User info -->
                        <div class="flex items-center mt-4">
                            <img src="https://i.pravatar.cc/50" alt="User Avatar" class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <p class="font-bold text-gray-900">Miranda Kehlani</p>
                                <p class="text-sm text-gray-500">STUTTGART</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center items-center px-4 py-6">
                <div class="w-full bg-white rounded-xl border overflow-hidden transform transition duration-500">
                    <div class="relative">
                        <img class="w-full h-64 object-cover"
                            src="https://images.unsplash.com/photo-1540206395-68808572332f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                            alt="Nature scene">
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900">If you could live anywhere in the world, where would
                            you pick?</h2>
                        <!-- User info -->
                        <div class="flex items-center mt-4">
                            <img src="https://i.pravatar.cc/50" alt="User Avatar" class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <p class="font-bold text-gray-900">Miranda Kehlani</p>
                                <p class="text-sm text-gray-500">STUTTGART</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

const navigateToFind = () => {
    window.location.href = '/find-partner';
}
</script>
