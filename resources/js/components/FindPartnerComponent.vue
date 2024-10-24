<template>
    <article class="relative isolate flex flex-col rounded-2xl px-8 pb-8 pt-[20rem] max-w-lg mx-auto">
        <!-- Gambar sebagai latar belakang -->
        <img src="https://i.pravatar.cc/1000" alt="University of Southern California"
            class="absolute inset-0 h-full w-full object-cover">
        <!-- Overlay untuk efek gradasi -->
        <div class="absolute inset-0 bg-gradient-to-t from-[#4b164c8d] via-[#4b164c0f]"></div>

        <!-- Navigasi ditempatkan di atas gambar -->
        <div class="absolute top-6 left-6 right-6 z-20 flex items-center justify-between">
            <a href="/dashboard"
                class="text-gray-100 px-3 py-2 rounded-full hover:bg-gray-300 hover:text-gray-800 transition duration-300 border border-white">
                <i class="fas fa-arrow-left"></i>
            </a>

            <a href="#"
                class="text-gray-100 px-3 py-2 rounded-full bg-white bg-opacity-30 backdrop-blur-lg hover:bg-opacity-50 hover:bg-gray-300 hover:text-gray-800 transition duration-300 border border-white">
                <i class="fa-solid fa-location-dot"></i>&nbsp; 2.5KM
            </a>
        </div>

        <!-- Tombol di bagian bawah gambar -->
        <div class="z-10 flex justify-center text-sm leading-6 text-gray-300">
            <div
                class="flex space-x-4 justify-center bg-white/20 backdrop-blur-lg p-2 rounded-full shadow-lg border border-white/30">
                <button
                    class="bg-white shadow-md text-gray-800 font-bold uppercase text-xs rounded-full px-4 py-3 hover:bg-yellow-500 transition duration-300">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <button
                    class="bg-[#4B174C] text-white font-bold uppercase text-xs rounded-full px-4 py-3 hover:bg-blue-600 transition duration-300">
                    <i class="fa-solid fa-star"></i>
                </button>
                <button
                    class="bg-[#DD88CF] text-white font-bold uppercase text-xs rounded-full px-4 py-3 hover:bg-rose-500 transition duration-300">
                    <i class="fa-solid fa-heart"></i>
                </button>
            </div>
        </div>
    </article>


    <div class="flex flex-col h-[390px] overflow-y-auto flex-1 p-6">
        <div class="relative text-center text-black">
            <!-- Nama dan Lokasi -->
            <h2 class="text-3xl font-bold mb-1">Alfredo Calzoni, 20</h2>
            <p class="text-lg mb-4">Hamburg, Germany</p>
        </div>
        <!-- About Section -->
        <div class="text-left mb-4">
            <h3 class="text-lg font-bold mb-2">About</h3>
            <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis vel
                accusantium dolor distinctio rerum ipsum, facere et nam, modi tenetur, ut necessitatibus ipsam nihil.
                Atque voluptas, praesentium voluptatibus et eius provident quaerat rerum illum consequatur aspernatur
                sed porro cupiditate non voluptate maiores quas nesciunt, earum necessitatibus id officiis perferendis.
                Vitae tempora repellat impedit dolores illum nostrum similique totam, nemo optio. Harum provident
                nesciunt, vitae reiciendis enim sapiente numquam omnis mollitia beatae dignissimos recusandae aliquam
                adipisci animi velit iusto aut, error facere. Laboriosam laborum temporibus labore laudantium ad modi
                commodi, unde veritatis sint necessitatibus expedita dignissimos ex quia officia, iure vero. 😍.</p>

            <!-- Hobi -->
            <div class="inline-block">
                <span
                    class="text-black text-xs font-bold uppercase rounded-full border border-black px-3 py-1 mr-2 mb-2 inline-block">
                    🌿 Nature
                </span>
                <span
                    class="text-black text-xs font-bold uppercase rounded-full border border-black px-3 py-1 mr-2 mb-2 inline-block">
                    ⛰ Traveling
                </span>
                <span
                    class="text-black text-xs font-bold uppercase rounded-full border border-black px-3 py-1 mr-2 mb-2 inline-block">
                    🎨 Art
                </span>
                <span
                    class="text-black text-xs font-bold uppercase rounded-full border border-black px-3 py-1 inline-block">
                    🎶 Music
                </span>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
