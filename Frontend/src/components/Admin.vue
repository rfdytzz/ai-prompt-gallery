<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute()
const router = useRouter()

const isOpenMenu = ref(false)
const openMenu = () => {
    isOpenMenu.value = !isOpenMenu.value
}

const name = ref('')
const role = ref('')
const getData = async () => {
    try {
        const token = localStorage.getItem('token')
        const res = await axios.get('http://localhost:8000/api/user',
            {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }
        )
        console.log(res.data.name)
        name.value = res.data.name
        role.value = res.data.role
    } catch (error) {
        console.log(error)
    }
}

const logout = async () => {
    try {
        const token = localStorage.getItem('token')
        await axios.post('http://localhost:8000/api/logout',
            {},
            {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }
        )
        localStorage.removeItem('token')
        router.push('/login/username')
    } catch (error) {
        console.log(error)
    }
}

onMounted(() => {
    getData()
})

</script>

<template>
    <div class="w-64 fixed flex justify-between flex-col z-50 left-0 top-0 h-screen shadow-xl border-r-2 border-gray-200">
        <div class="flex p-5 flex-col gap-10">
            <div class="flex flex-col">
                <h1 class="font-semibold text-xl">Dashboard</h1>
                <p class="font-bold text-xl">D<span class="text-blue-500">way</span> Prompt</p>
            </div>
            <ul class="flex text-sm flex-col gap-1">
                <router-link :class="route.path === '/dashboard' ? 'bg-gray-100' : ''" class="font-semibold hover:bg-gray-100 rounded-xl transition duration-100 p-3 flex gap-2 items-center" to="/dashboard" ><i class='bx bx-tachometer'></i> Dashboard</router-link>
                <router-link :class="route.path === '/dashboard/allusers' ? 'bg-gray-100' : ''" class="font-semibold hover:bg-gray-100 rounded-xl transition duration-100 p-3 flex gap-2 items-center" to="/dashboard/allusers"><i class='bx bxs-user-account' ></i> All Users</router-link>
                <router-link :class="route.path === '/dashboard/prompt' ? 'bg-gray-100' : ''" class="font-semibold hover:bg-gray-100 rounded-xl transition duration-100 p-3 flex gap-2 items-center" to="/dashboard/prompt"><i class='bx bx-command' ></i> Prompt Management</router-link>
            </ul>
        </div>
        <div class="flex gap-5 flex-col">
            <hr class="text-gray-300">
            <div class="flex px-5 pb-5 items-center justify-between">
                <img src="/img/sampleman.jpg" class="size-11 rounded-full" alt="">
                <div class="text-end">
                    <p class="font-semibold text-sm capitalize">{{ name }}</p>
                    <p class="text-sm capitalize">{{ role }}</p>
                </div>
            </div>
        </div>
    </div>

    <div @click="openMenu" class="flex fixed shadow-xl ring ring-gray-200 right-6 top-4 gap-2 items-center bg-gray-100 cursor-pointer px-3 py-2 rounded-full">
        <img src="/img/sampleman.jpg" class="rounded-full border border-gray-100 h-8 w-8 object-cover" alt="">
        <p>Admin</p>
    </div>
    <div :class="isOpenMenu ? 'visible opacity-100' : 'invisible opacity-0'" class="fixed transition bg-white duration-00 shadow border border-gray-200 right-6 top-19 rounded-xl">
        <ul class="flex flex-col">
            <button class="text-md py-3 px-5 cursor-pointer hover:bg-gray-100 rounded-t-xl transition duration-100 items-center flex gap-2"><i class='bx bx-user-circle' ></i> Profile</button>
            <button class="text-md py-3 px-5 cursor-pointer hover:bg-gray-100 rounded transition duration-100 items-center flex gap-2"><i class='bx bx-cog' ></i> Settings</button>
            <button class="text-md py-3 px-5 cursor-pointer hover:bg-gray-100 transition duration-100 items-center flex gap-2"><i class='bx bx-lock-alt' ></i> Change Password</button>
            <button @click="logout" class="text-md py-3 px-5 cursor-pointer hover:bg-red-400 hover:text-white text-red-500 rounded-b-xl transition duration-200 items-center flex gap-2"><i class='bx bx-log-out' ></i> Logout</button>
        </ul>
    </div>

</template>