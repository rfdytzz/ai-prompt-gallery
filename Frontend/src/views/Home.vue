<script setup>
import Nav from '@/components/Nav.vue';
</script>

<template>
    <Nav />
    <div class="w-full pt-18 h-screen">
        <div class="flex flex-col gap-5 justify-center items-center py-10 bg-gray-900 text-white">
            <p class="text-[30px] font-bold">All Prompt</p>
            <div class="flex">
                <input type="text" class="p-3 w-150 focus:outline-lime-500 shadow outline-2 outline-gray-500 rounded bg-white text-black" placeholder="Search..." name="" id="">
            </div>
            <div class="flex gap-4">
                <div class="bg-white items-center pr-2 text-black">
                    <select name="" class="p-3 focus:outline-2 focus:outline-lime-500" id="">
                        <option value="">Select Category</option>
                        <option value="">Image Generation</option>
                    </select>
                </div>
                <button class="bg-lime-500 py-3 px-4 cursor-pointer">Filter</button>
            </div>
        </div>
    </div>
</template>