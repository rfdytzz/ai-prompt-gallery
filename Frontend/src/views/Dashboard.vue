<script setup>
import Admin from '@/components/Admin.vue';
</script>

<template>
    <Admin />
    <div class="fixed right-0 left-64 items-center p-5 flex justify-between">
        <h1 class="font-semibold text-lg">Admin Panel</h1>
        <div class="flex gap-2 items-center bg-gray-200 cursor-pointer px-3 py-2 rounded-full">
            <img src="/img/sampleman.jpg" class="rounded-full border border-gray-100 h-8 w-8 object-cover" alt="">
            <p>Admin</p>
        </div>
    </div>
    <div class="fixed shadow right-6 top-20 rounded-xl">
        <ul class="flex flex-col">
            <button class="text-md py-3 px-5 cursor-pointer hover:bg-gray-100 rounded-t-xl transition duration-100 items-center flex gap-2"><i class='bx bx-user-circle' ></i> Profile</button>
            <button class="text-md py-3 px-5 cursor-pointer hover:bg-gray-100 rounded transition duration-100 items-center flex gap-2"><i class='bx bx-cog' ></i> Settings</button>
            <button class="text-md py-3 px-5 cursor-pointer hover:bg-gray-100 transition duration-100 items-center flex gap-2"><i class='bx bx-lock-alt' ></i> Change Password</button>
            <button class="text-md py-3 px-5 cursor-pointer hover:bg-red-400 hover:text-white text-red-500 rounded-b-xl transition duration-200 items-center flex gap-2"><i class='bx bx-log-out' ></i> Logout</button>
        </ul>
    </div>
</template>