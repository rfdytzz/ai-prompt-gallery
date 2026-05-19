<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import Swal from 'sweetalert2'

const user = ref({})
const route = useRoute()
const router = useRouter()

const sidebar = ref(false)
const openSidebar = () => {
    sidebar.value = !sidebar.value
}

const getData = async () => {
    try {
        const token = localStorage.getItem('token')
        const res = await axios.get('http://localhost:8000/api/user',
            {
                headers: {
                    Authorization: `bearer ${token}`
                }
            }
        )
        console.log(res.data)
        user.value = res.data
    } catch (error) {
        console.log(error)
    }
}

const message = ref('')

const logout = async () => {
    try {
        const token = localStorage.getItem('token')
        const res = await axios.post('http://localhost:8000/api/logout',
            {},
            {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }
        )
        message.value = res.data.message
        localStorage.removeItem('token')
        router.push('/login')
    } catch (error) {
        console.log(error)
    }
}

const isOpen = ref(false)

const openMenu = () => {
    isOpen.value = !isOpen.value
}

onMounted( () => {
    getData()
})

</script>

<template>
    <div class="bg-gray-900 border-b-2 border-lime-500 justify-between fixed z-50 flex items-center w-full h-20 text-white p-5">
        <h1 @click="openMenu" class="font-bold text-[30px]">Lo<span class="text-lime-500">go</span></h1>
        <div class="hidden md:block lg:block">
            <ul class="flex gap-5">
                <router-link to="/" class="hover:text-lime-500 transition duration-200" :class="route.path === '/' ? 'text-lime-500' : ''">Home</router-link>
                <router-link to="" class="hover:text-lime-500 transition duration-200" :class="route.path === '/about' ? 'text-lime-500' : ''">About</router-link>
                <router-link to="/prompt" class="hover:text-lime-500 transition duration-200" :class="route.path === '/prompt' ? 'text-lime-500' : ''">Prompt</router-link>
            </ul>
        </div>
        <div class="flex gap-2 items-center">
            <div class="hidden md:block lg:block">
                <div class="flex gap-5 items-center">
                    <div @click="openMenu" class="cursor-pointer"><i class='bx bx-user-circle text-[38px] mt-1'></i></div>
                </div>
            </div>
            <div class="block md:hidden lg:hidden">
                <button @click="openSidebar" class="flex flex-col gap-2 cursor-pointer">
                    <span class="h-0.5 w-6 bg-white"></span>
                    <span class="h-0.5 w-6 bg-white"></span>
                    <span class="h-0.5 w-6 bg-white"></span>
                </button>
            </div>
        </div>
    </div>
    <ul :class="isOpen ? 'translate-y-0' : '-translate-y-full'" class="flex  text-white flex-col fixed z-40 transition duration-100 top-19 bg-gray-900 w-40 right-0 border-lime-500 border-2">
        <router-link to="" class="flex items-center gap-2 hover:bg-gray-800 px-3 py-3"><i class='bx bx-user-circle' ></i> Profile</router-link>
        <router-link to="" class="flex items-center gap-2 hover:bg-gray-800 px-3 py-3"><i class='bx bx-cog' ></i> Settings</router-link>
        <button @click="logout" class="flex items-center cursor-pointer gap-2 bg-red-800 hover:bg-red-700 px-3 py-3"><i class='bx bx-log-out' ></i> Logout</button>
    </ul>
    <div :class="sidebar ? 'translate-x-0' : '-translate-x-full'" class="w-64 fixed h-screen text-white transition duration-200 bg-gray-900 pt-30 p-5">
        <ul class="flex flex-col gap-2">
            <router-link class="text-[20px] p-3 hover:bg-gray-800 hover:text-lime-500" :class="route.path === '/' ? 'bg-gray-800' : ''" to="/">Home</router-link>
            <router-link class="text-[20px] p-3 hover:bg-gray-800 hover:text-lime-500" :class="route.path === '/about' ? 'bg-gray-800' : ''" to="">About</router-link>
            <router-link class="text-[20px] p-3 hover:bg-gray-800 hover:text-lime-500" :class="route.path === '/prompt' ? 'bg-gray-800' : ''" to="/prompt">Prompt</router-link>
            <router-link class="text-[20px] p-3 hover:bg-gray-800 hover:text-lime-500" :class="route.path === '/profile' ? 'bg-gray-800' : ''" to="/prompt">Profile</router-link>
        </ul>
    </div>
</template>