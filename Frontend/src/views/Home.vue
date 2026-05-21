<script setup>
import Nav from '@/components/Nav.vue';
import { onMounted } from 'vue';
onMounted(() => {
    document.title = 'Home | DwayPrompts'
})
</script>

<template>
    <Nav />
    <div class="w-full pt-30 z-10 h-screen">
        <section class="relative py-24 px-6 bg-linear-to-br from-blue-700 via-blue-700 to-blue-900 overflow-hidden">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZGVmcz48cGF0dGVybiBpZD0iZ3JpZCIgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBwYXR0ZXJuVW5pdHM9InVzZXJTcGFjZU9uVXNlIj48cGF0aCBkPSJNIDQwIDAgTCAwIDAgMCA0MCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLW9wYWNpdHk9IjAuMSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI2dyaWQpIi8+PC9zdmc+')] opacity-30"></div>
                <div class="relative max-w-4xl mx-auto text-center">
                <div class="flex justify-center gap-5">
                    <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur rounded-full text-white text-sm font-medium mb-6">
                    <i class='bx bx-image' ></i> Image Generator
                    </span>
                    <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur rounded-full text-white text-sm font-medium mb-6">
                    <i class='bx bx-edit-alt' ></i> Ai Text
                    </span>
                    <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur rounded-full text-white text-sm font-medium mb-6">
                    <i class='bx bx-video' ></i> Ai Video
                    </span>
                    <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur rounded-full text-white text-sm font-medium mb-6">
                    <i class='bx bx-code-alt' ></i> Programming
                    </span>
                </div>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                Use or Share Amazing Prompt
            </h1>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                Premium quality Tailwind CSS components that make your projects stand out.
            </p>
            <router-link to="/prompt" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors shadow-xl">
                Explore Prompts
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </router-link>
            </div>
        </section>
    </div>
</template>