<script setup>
import Nav from '@/components/Nav.vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';

const data = ref([])
const search = ref('')

const getData = async () => {
    try {
        const res = await axios.get('http://localhost:8000/api/prompt',
            {
                params: {
                    search: search.value
                }
            }
        )
        console.log(res.data)
        data.value = res.data
    } catch (error) {
        console.log(error)
    }
}

const click = async (text) => {
    await navigator.clipboard.writeText(text)
    return alert('Copied')
}

onMounted ( () => {
    getData()
})

</script>

<template>
    <Nav />
    <div class="w-full pt-18 h-screen">
        <div class="flex flex-col gap-5 justify-center items-center py-10 bg-white text-gray-900">
            <p class="text-[30px] font-bold">All Prompt</p>
            <form action="" class="flex items-center flex-row gap-5">
                <div class="flex">
                    <input v-model="search" type="text" class="p-3 w-150 focus:outline-lime-500 shadow outline-2 outline-gray-500 rounded bg-white text-black" placeholder="Search..." name="" id="">
                </div>
            </form>
        </div>
        <div class="grid-cols-4 grid justify-items-center">
            <div :key="index" v-for="(item, index) in data.filter(i => i.category.category.toLowerCase().includes('image generation') && i.title.toLowerCase().includes(search.toLowerCase()))" class="flex-col w-82 mb-5 overflow-hidden p-4 rounded shadow hover:shadow-2xl transition-all duration-200 flex">
                <div class="flex gap-5 mb-5 max-w-full items-center justify-between">
                    <h2 class="font-bold text-[20px] w-40">{{ item.title }}</h2>
                    <p class="rounded-xl p-1 text-[12px] font-bold text-white border-2 border-lime-500 bg-lime-500/50">{{ item.category.category }}</p>
                </div>
                <img src="/img/prompt.jpeg" class="hover:scale-105 mb-5 w-full h-full rounded transition duration-200" alt="">
                <p class="max-w-full mb-5 font-bold">{{ item.description }}</p>
                <p class="p-3 bg-gray-300/50 mb-5 border-gray-300 border-2 rounded bo">{{ item.prompt }}</p>
                <div class="flex justify-between items-center">
                    <div @click="click(item.prompt, index)" class="p-2 bg-lime-500/50 flex gap-2 items-center w-fit text-lime-700 border-2 cursor-pointer transition shadow hover:shadow-xl duration-200 rounded border-lime-500">
                        <i class='bx bx-copy-alt'></i><p class="font-bold text-lime-700">Copy Prompt</p>
                    </div>
                    <div class="flex gap-2">
                        <div class="flex items-center justify-center gap-1 p-2 bg-lime-500/50 border-2 border-lime-500 rounded-xl cursor-pointer text-lime-700 transition duration-200 shadow hover:shadow-2xl">
                            <i class='bx bx-like text-[20px]' ></i>112
                        </div>
                        <div class="flex items-center justify-center p-2 bg-yellow-500/50 border-2 border-yellow-500 rounded-xl cursor-pointer text-yellow-700 transition duration-200 shadow hover:shadow-2xl">
                            <i class='bx bx-share text-[20px]' ></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>