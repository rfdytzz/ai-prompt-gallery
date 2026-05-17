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

onMounted ( () => {
    getData()
})

</script>

<template>
    <Nav />
    <div class="w-full pt-18 h-screen">
        <div class="flex flex-col gap-5 justify-center items-center py-10 bg-gray-900 text-white">
            <p class="text-[30px] font-bold">All Prompt</p>
            <form action="" class="flex items-center flex-col gap-5">
                <div class="flex">
                    <input v-model="search" type="text" class="p-3 w-150 focus:outline-lime-500 shadow outline-2 outline-gray-500 rounded bg-white text-black" placeholder="Search..." name="" id="">
                </div>
                <div class="flex gap-4">
                    <div class="bg-white focus-within:outline-2 focus-within:outline-lime-500 items-center pr-2 text-black">
                        <select name="" class="p-3 focus:outline-0" id="">
                            <option value="">Select Category</option>
                            <option value="">Image Generation</option>
                        </select>
                    </div>
                    <button class="bg-lime-500 py-3 px-4 cursor-pointer">Filter</button>
                </div>
            </form>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mt-10 w-full justify-items-center">
            <div v-for="(item, index) in data.filter(i => i.title.toLowerCase().includes(search.toLowerCase()))" @input="getData" :key="index" class="w-76 mb-5 shadow transition rounded duration-200 hover:shadow-xl">
                <div class="w-full h-32 overflow-hidden">
                    <img src="/img/prompt.jpeg" class="w-full h-full object-cover transition duration-300 hover:scale-110">
                </div>
                <div class="p-3 flex flex-col pb-7">
                    <p class="text-[13px] text-end">@{{ item.author.username }}</p>
                    <h5 class="font-bold text-[18px] mb-2">{{ item.title }}</h5>
                    <p class="mb-5 text-[13px]">{{ item.description }}</p>
                    <router-link to="" class="px-1 py-2 text-center hover:bg-lime-400 transition duration-200 rounded text-white flex-1 bg-lime-500">Use Prompt</router-link>
                </div>
            </div>
        </div>
    </div>
</template>