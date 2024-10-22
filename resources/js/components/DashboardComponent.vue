<template>
    <div class="items-center rounded-b-md py-5 px-5 bg-[#4B164C]">
        <div class="flex items-center py-1 px-1">
            <a href="/dashboard"
                class="text-white px-3 py-2 rounded-full hover:bg-gray-300 hover:text-gray-800 transition duration-300 border border-white">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="flex-1 text-center text-white font-bold text-xl">Messages</h1>
        </div>

        <div class="mt-8 px-5">
            <h2 class="text-white text-lg mb-4">Recent Matches</h2>
            <div class="flex space-x-1 overflow-x-auto snap-x snap-mandatory scroll-smooth">
                <div class="relative snap-center">
                    <img src="https://ui-avatars.com/api/?name=John" alt="match-1"
                        class="rounded-xl w-24 h-28 object-cover" />
                    <div
                        class="absolute bottom-2 right-2 bg-white rounded-full p-1 flex items-center justify-center w-6 h-6">
                        <span class="text-purple-600 text-xs font-bold">32</span>
                    </div>
                </div>
                <div class="relative snap-center">
                    <img src="https://ui-avatars.com/api/?name=Jane" alt="match-2"
                        class="rounded-xl w-24 h-28 object-cover" />
                </div>
                <div class="relative snap-center">
                    <img src="https://ui-avatars.com/api/?name=Tom" alt="match-3"
                        class="rounded-xl w-24 h-28 object-cover" />
                </div>
                <div class="relative snap-center">
                    <img src="https://ui-avatars.com/api/?name=Sarah" alt="match-4"
                        class="rounded-xl w-24 h-28 object-cover" />
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white h-[520px]">
        <div class="overflow-y-auto h-full">
            <div class="flex justify-between items-center border-b py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-1"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">JASIMAN Calzoni</h3>
                        <p class="text-gray-500 text-sm">What about that new jacket if I ...</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">09:18</span>
                </div>
            </div>

            <div class="flex justify-between items-center border-b py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-2"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">Clara Hazel</h3>
                        <p class="text-gray-500 text-sm">I know right 😉</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">12:44</span>
                </div>
            </div>

            <div class="flex justify-between items-center border-b py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-3"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">Brandon Aminoff</h3>
                        <p class="text-gray-500 text-sm">I’ve already registered, can’t wait ...</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">08:06</span>
                </div>
            </div>
            <div class="flex justify-between items-center border-b py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-3"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">Brandon Aminoff</h3>
                        <p class="text-gray-500 text-sm">I’ve already registered, can’t wait ...</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">08:06</span>
                </div>
            </div>
            <div class="flex justify-between items-center border-b py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-3"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">Brandon Aminoff</h3>
                        <p class="text-gray-500 text-sm">I’ve already registered, can’t wait ...</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">08:06</span>
                </div>
            </div>
            <div class="flex justify-between items-center border-b py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-3"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">Brandon Aminoff</h3>
                        <p class="text-gray-500 text-sm">I’ve already registered, can’t wait ...</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">08:06</span>
                </div>
            </div>
            <div class="flex justify-between items-center border-b py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-3"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">Brandon Aminoff</h3>
                        <p class="text-gray-500 text-sm">I’ve already registered, can’t wait ...</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">08:06</span>
                </div>
            </div>
            <div class="flex justify-between items-center border-b py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-3"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">Brandon Aminoff</h3>
                        <p class="text-gray-500 text-sm">I’ve already registered, can’t wait ...</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">08:06</span>
                </div>
            </div>
            <div class="flex justify-between items-center border-b py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-3"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">Brandon Aminoff</h3>
                        <p class="text-gray-500 text-sm">I’ve already registered, can’t wait ...</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">08:06</span>
                </div>
            </div>

            <div class="flex justify-between items-center py-6 px-8">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=oo" alt="profile-4"
                        class="rounded-full w-12 h-12 mr-3" />
                    <div>
                        <h3 class="font-bold">Amina Mina</h3>
                        <p class="text-gray-500 text-sm">It will have two lines of heading ...</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block w-3 h-3 bg-[#DD88CF] rounded-full mt-1"></span>
                    <span class="text-sm text-gray-400">09:32</span>
                </div>
            </div>
        </div>
    </div>
</template>