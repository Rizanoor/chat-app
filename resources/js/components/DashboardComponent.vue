<template>
    <div class="items-center rounded-b-md py-5 px-5">
        <!-- Header -->
        <div class="flex items-center py-2 px-2">
            <button
                class="text-[#5E296B] border border-[#E4ACD4] rounded-full px-3 py-2 hover:bg-[#E4ACD4] transition ease-in-out duration-300">
                <i class="fas fa-arrow-left"></i>
            </button>
            <h1 class="flex-1 text-center text-3xl font-bold text-[#5E296B]">Matches</h1>
        </div>

        <!-- Stories Section -->
        <div class="flex space-x-4 px-4 overflow-x-auto mt-4">
            <div class="flex flex-col items-center">
                <div class="relative">
                    <img src="https://i.pravatar.cc/100" alt="My Story"
                        class="rounded-full w-20 h-15 border-4 border-red-300">
                </div>
                <p class="text-sm mt-2 text-center text-gray-800">Like <span class="text-[#E4ACD4] font-bold">32</span>
                </p>
            </div>
            <div class="flex flex-col items-center">
                <img src="https://i.pravatar.cc/100?img=1" alt="Selena"
                    class="rounded-full w-20 h-15 border-4 border-[#E4ACD4]">
                <p class="text-sm mt-2 text-center text-gray-800">Like <span class="text-[#E4ACD4] font-bold">10</span>
                </p>
            </div>
            <div class="flex flex-col items-center">
                <img src="https://i.pravatar.cc/100?img=2" alt="Clara"
                    class="rounded-full w-20 h-15 border-4 border-[#E4ACD4]">
                <p class="text-sm mt-2 text-center text-gray-800">Like <span class="text-[#E4ACD4] font-bold">20</span>
                </p>
            </div>
            <div class="flex flex-col items-center">
                <img src="https://i.pravatar.cc/100?img=3" alt="Fabian"
                    class="rounded-full w-20 h-15 border-4 border-[#E4ACD4]">
                <p class="text-sm mt-2 text-center text-gray-800">Like <span class="text-[#E4ACD4] font-bold">40</span>
                </p>
            </div>
            <div class="flex flex-col items-center">
                <img src="https://i.pravatar.cc/100?img=4" alt="Gwen"
                    class="rounded-full w-20 h-15 border-4 border-[#E4ACD4]">
                <p class="text-sm mt-2 text-center text-gray-800">Like <span class="text-[#E4ACD4] font-bold">11</span>
                </p>
            </div>
        </div>
    </div>

    <div class="flex flex-col h-[66vh] overflow-y-auto px-6">
        <div class="justify-center px-4">
            <h1 class="text-left text-xl font-bold text-[#5E296B]">Your Matches <span
                    class="text-[#E4ACD4] font-bold">32</span></h1>
        </div>

        <div class="overflow-y-auto px-4 py-6">
            <div class="grid grid-cols-2 gap-4 justify-items-center">
                <!-- Card 1 -->
                <div class="bg-white rounded-xl shadow-md border border-[#E4ACD4] p-3 w-48 relative">
                    <div
                        class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#E4ACD4] text-white text-xs font-bold py-1 px-3 rounded-full">
                        10% Match
                    </div>
                    <img class="rounded-lg w-full h-40 object-cover" src="https://i.pravatar.cc/200" alt="James">
                    <div class="mt-4 text-center">
                        <div class="text-sm text-gray-800 bg-gray-500 bg-opacity-20 backdrop-blur-md rounded-full px-2 py-1 inline-block mb-2 border border-white">
                            3.3 km away
                        </div>
                        <h2 class="text-lg font-bold text-gray-900">James, 20</h2>
                        <p class="text-sm text-gray-500">HANOVER</p>
                    </div>

                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-xl shadow-md border border-[#E4ACD4] p-3 w-48 relative">
                    <div
                        class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#E4ACD4] text-white text-xs font-bold py-1 px-3 rounded-full">
                        94% Match
                    </div>
                    <img class="rounded-lg w-full h-40 object-cover" src="https://i.pravatar.cc/201" alt="Eddie">
                    <div class="mt-4 text-center">
                        <div class="text-sm text-gray-800 bg-gray-500 bg-opacity-20 backdrop-blur-md rounded-full px-2 py-1 inline-block mb-2 border border-white">
                            1.3 km away
                        </div>
                        <h2 class="text-lg font-bold text-gray-900">James, 20</h2>
                        <p class="text-sm text-gray-500">HANOVER</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md border border-[#E4ACD4] p-3 w-48 relative">
                    <div
                        class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#E4ACD4] text-white text-xs font-bold py-1 px-3 rounded-full">
                        94% Match
                    </div>
                    <img class="rounded-lg w-full h-40 object-cover" src="https://i.pravatar.cc/201" alt="Eddie">
                    <div class="mt-4 text-center">
                        <div class="text-sm text-gray-800 bg-gray-500 bg-opacity-20 backdrop-blur-md rounded-full px-2 py-1 inline-block mb-2 border border-white">
                            1.3 km away
                        </div>
                        <h2 class="text-lg font-bold text-gray-900">James, 20</h2>
                        <p class="text-sm text-gray-500">HANOVER</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md border border-[#E4ACD4] p-3 w-48 relative">
                    <div
                        class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#E4ACD4] text-white text-xs font-bold py-1 px-3 rounded-full">
                        94% Match
                    </div>
                    <img class="rounded-lg w-full h-40 object-cover" src="https://i.pravatar.cc/201" alt="Eddie">
                    <div class="mt-4 text-center">
                        <div class="text-sm text-gray-800 bg-gray-500 bg-opacity-20 backdrop-blur-md rounded-full px-2 py-1 inline-block mb-2 border border-white">
                            1.3 km away
                        </div>
                        <h2 class="text-lg font-bold text-gray-900">James, 20</h2>
                        <p class="text-sm text-gray-500">HANOVER</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md border border-[#E4ACD4] p-3 w-48 relative">
                    <div
                        class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#E4ACD4] text-white text-xs font-bold py-1 px-3 rounded-full">
                        94% Match
                    </div>
                    <img class="rounded-lg w-full h-40 object-cover" src="https://i.pravatar.cc/201" alt="Eddie">
                    <div class="mt-4 text-center">
                        <div class="text-sm text-gray-800 bg-gray-500 bg-opacity-20 backdrop-blur-md rounded-full px-2 py-1 inline-block mb-2 border border-white">
                            1.3 km away
                        </div>
                        <h2 class="text-lg font-bold text-gray-900">James, 20</h2>
                        <p class="text-sm text-gray-500">HANOVER</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md border border-[#E4ACD4] p-3 w-48 relative">
                    <div
                        class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#E4ACD4] text-white text-xs font-bold py-1 px-3 rounded-full">
                        94% Match
                    </div>
                    <img class="rounded-lg w-full h-40 object-cover" src="https://i.pravatar.cc/201" alt="Eddie">
                    <div class="mt-4 text-center">
                        <div class="text-sm text-gray-800 bg-gray-500 bg-opacity-20 backdrop-blur-md rounded-full px-2 py-1 inline-block mb-2 border border-white">
                            1.3 km away
                        </div>
                        <h2 class="text-lg font-bold text-gray-900">James, 20</h2>
                        <p class="text-sm text-gray-500">HANOVER</p>
                    </div>
                </div>

            </div>
        </div>

    </div>

</template>

<script setup>
</script>