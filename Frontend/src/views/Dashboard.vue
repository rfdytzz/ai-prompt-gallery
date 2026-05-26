<script setup>
import Admin from '@/components/Admin.vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';

const isOpenMenu = ref(false)
const openMenu = () => {
    isOpenMenu.value = !isOpenMenu.value
}

const name = ref('')
const getUser = async () => {
    try {
        const token = localStorage.getItem('token')
        const res = await axios.get('http://localhost:8000/api/user',
            {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }
        )
        name.value = res.data.name
        console.log(res.data)
    } catch (error) {
        console.log(error)
    }
}

const data = ref([])
const getData = async () => {
    try {
        const res = await axios.get('http://localhost:8000/api/dashboard',)
        data.value = res.data
    } catch (error) {
        console.log(error)
    }
}

onMounted(() => {
    getUser(),
    getData()
})

</script>

<template>
    <Admin />
    <div class="fixed right-0 left-64 items-center p-5 flex justify-between">
        <h1 class="font-semibold text-lg">Admin Panel</h1>
        <div @click="openMenu" class="flex gap-2 items-center bg-gray-200 cursor-pointer px-3 py-2 rounded-full">
            <img src="/img/sampleman.jpg" class="rounded-full border border-gray-100 h-8 w-8 object-cover" alt="">
            <p>Admin</p>
        </div>
    </div>
    <div :class="isOpenMenu ? 'visible opacity-100' : 'invisible opacity-0'" class="fixed transition duration-00 shadow right-6 top-20 rounded-xl">
        <ul class="flex flex-col">
            <button class="text-md py-3 px-5 cursor-pointer hover:bg-gray-100 rounded-t-xl transition duration-100 items-center flex gap-2"><i class='bx bx-user-circle' ></i> Profile</button>
            <button class="text-md py-3 px-5 cursor-pointer hover:bg-gray-100 rounded transition duration-100 items-center flex gap-2"><i class='bx bx-cog' ></i> Settings</button>
            <button class="text-md py-3 px-5 cursor-pointer hover:bg-gray-100 transition duration-100 items-center flex gap-2"><i class='bx bx-lock-alt' ></i> Change Password</button>
            <button class="text-md py-3 px-5 cursor-pointer hover:bg-red-400 hover:text-white text-red-500 rounded-b-xl transition duration-200 items-center flex gap-2"><i class='bx bx-log-out' ></i> Logout</button>
        </ul>
    </div>

    <div class="items-center grid grid-cols-4 w-full gap-5 pl-69 pt-30 pr-5 justify-between">
        <div class="shadow p-5 col-span-4 rounded hover:shadow-xl transition duration-100 border border-gray-200">
            <h1 class="font-normal text-md">Hi! Welcome back <span class="font-semibold">{{ name }}</span></h1>
        </div>
        <div class="shadow p-5 flex flex-col gap-2 col-span-1 rounded hover:shadow-xl transition duration-100 border border-gray-200">
            <div class="font-normal text-md flex items-center gap-2"><i class='bx bx-user' ></i> Total User</div>
            <h2 class="text-4xl">{{ data.totalUser }}</h2>
        </div>
        <div class="shadow p-5 flex flex-col gap-2 col-span-1 rounded hover:shadow-xl transition duration-100 border border-gray-200">
            <div class="font-normal text-md flex items-center gap-2"><i class='bx bx-user' ></i> Total User</div>
            <h2 class="text-4xl">{{ data.totalPrompt }}</h2>
        </div>
        <div class="shadow p-5 flex flex-col gap-2 col-span-1 rounded hover:shadow-xl transition duration-100 border border-gray-200">
            <div class="font-normal text-md flex items-center gap-2"><i class='bx bx-user' ></i> Total User</div>
            <h2 class="text-4xl">{{ data.totalCategory }}</h2>
        </div>
        <div class="shadow p-5 flex flex-col gap-2 col-span-1 rounded hover:shadow-xl transition duration-100 border border-gray-200">
            <div class="font-normal text-md flex items-center gap-2"><i class='bx bx-user' ></i> Total User</div>
            <h2 class="text-4xl">{{ data.totalTag }}</h2>
        </div>
    </div>
</template>