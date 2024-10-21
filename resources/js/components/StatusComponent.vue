<template>
    <div class="flex flex-col h-full w-full">
      <div ref="contactContainer" class="overflow-y-auto flex-grow no-scrollbar">
        <div class="space-y-4">
          <div class="flex">
            <a
              href="/dashboard"
              class="mr-3 text-gray-800 px-3 py-2 rounded-full border hover:bg-gray-300 transition duration-300"
            >
              <i class="fas fa-arrow-left"></i>
            </a>
            <button
              @click="openMedia"
              class="bg-green-500 text-white p-2 rounded-lg block text-sm hover:bg-green-600 transition w-full"
            >
              + New Status
            </button>
          </div>
          <div v-if="showPreview" class="mt-4 relative">
            <video ref="video" class="w-full h-64 bg-black" autoplay playsinline></video>
            
            <button
              @click="stopMedia"
              class="inset-0 m-auto bg-red-500 mt-2 text-white p-4 rounded-full hover:bg-red-600 transition flex items-center justify-center"
              style="width: 60px; height: 60px;"
            >
              <i class="fa-solid fa-video-slash text-2xl"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { nextTick } from "vue";
  
  export default {
    data() {
      return {
        showPreview: false, // Untuk menampilkan preview media
        mediaStream: null,  // Untuk menyimpan stream media
      };
    },
    methods: {
      async openMedia() {
        try {
          const stream = await navigator.mediaDevices.getUserMedia({
            video: true,
            audio: true,
          });
  
          // Pastikan elemen video sudah tersedia sebelum menetapkan stream
          this.showPreview = true;
          await nextTick(); // Tunggu render selesai
  
          // Simpan stream dan tampilkan di elemen video
          this.mediaStream = stream;
          this.$refs.video.srcObject = stream;
        } catch (error) {
          console.error("Akses kamera/mikrofon ditolak:", error);
          alert("Tidak bisa mengakses kamera atau mikrofon.");
        }
      },
      stopMedia() {
        if (this.mediaStream) {
          this.mediaStream.getTracks().forEach((track) => track.stop());
          this.mediaStream = null;
  
          this.showPreview = false;
          this.$refs.video.srcObject = null;
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .video-container {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
  }
  </style>
  