<script setup>
import axios from 'axios';
import { computed, onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import Swal from 'sweetalert2'

const name = ref('')
const displayName = computed(() => {
    return name.value.split(' ')[0];
})
console.log(displayName)
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
        // console.log(res.data)
        name.value = res.data.name;
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
    <div class="bg-white text-black shadow justify-between fixed z-50 flex items-center w-full h-20 p-5">
        <h1 @click="openMenu" class="font-bold text-[30px]">Lo<span class="text-blue-500">go</span></h1>
        <div class="hidden md:block lg:block">
            <ul class="flex gap-5">
                <router-link to="/" class="hover:bg-gray-100 px-2 rounded-xl py-1 transition duration-200" :class="route.path === '/' ? 'bg-gray-100' : ''">Home</router-link>
                <router-link to="/prompt" class="hover:bg-gray-100 px-2 rounded-xl py-1 transition duration-200" :class="route.path === '/prompt' ? 'bg-gray-100' : ''">Prompt</router-link>
                <router-link to="/about" class="hover:bg-gray-100 px-2 rounded-xl py-1 transition duration-200" :class="route.path === '/about' ? 'bg-gray-100' : ''">About</router-link>
            </ul>
        </div>
        <div class="flex gap-2 items-center">
            <div class="hidden md:block lg:block">
                <div @click="openMenu" class="flex cursor-pointer gap-2 rounded-full bg-gray-100 px-3 py-2 items-center">
                    <div class="cursor-pointer"><img src="/public/img/sampleman.jpg" class="size-10 rounded-full" alt=""></div>
                    <div class="cursor-pointer hidden"><i class='bx bx-user-circle text-[53px] mt-1'></i></div>
                    <p>{{ displayName }}</p>
                </div>
            </div>
            <div class="block md:hidden lg:hidden">
                <button @click="openSidebar" class="flex flex-col gap-2 cursor-pointer">
                    <span class="h-0.5 w-6 bg-black"></span>
                    <span class="h-0.5 w-6 bg-black"></span>
                    <span class="h-0.5 w-6 bg-black"></span>
                </button>
            </div>
        </div>
    </div>
    <ul :class="isOpen ? 'block' : 'hidden'" class="flex text-black flex-col fixed z-50 transition duration-100 top-19 shadow-xl ring-1 ring-gray-200 bg-white w-40 right-5 rounded-xl">
        <router-link to="/profile" class="flex items-center gap-2 rounded-t-xl hover:bg-gray-100 px-3 py-3"><i class='bx bx-user-circle' ></i> Profile</router-link>
        <router-link to="/settings" class="flex items-center gap-2 hover:bg-gray-100 px-3 py-3"><i class='bx bx-cog' ></i> Settings</router-link>
        <button @click="logout" class="flex items-center hover:bg-red-500/20 rounded-b-xl text-red-500 gap-2 px-3 py-3 cursor-pointer"><i class='bx bx-log-out' ></i> Logout</button>
    </ul>
    <div :class="sidebar ? 'block' : 'hidden'" class="inset-0 fixed bg-black/50 z-30" @click="openSidebar"></div>
    <div :class="sidebar ? 'translate-x-0' : '-translate-x-full'" class="w-64 fixed h-screen text-black transition duration-200 z-40 bg-white pt-30 p-5">
        <ul class="flex flex-col gap-2">
            <router-link class="text-[20px] p-3 rounded-xl hover:bg-gray-100" :class="route.path === '/' ? 'bg-gray-100' : ''" to="/">Home</router-link>
            <router-link class="text-[20px] p-3 rounded-xl hover:bg-gray-100" :class="route.path === '/prompt' ? 'bg-gray-100' : ''" to="/prompt">Prompt</router-link>
            <router-link class="text-[20px] p-3 rounded-xl hover:bg-gray-100" :class="route.path === '/about' ? 'bg-gray-100' : ''" to="">About</router-link>
            <router-link class="text-[20px] p-3 rounded-xl hover:bg-gray-100" :class="route.path === '/profile' ? 'bg-gray-100' : ''" to="/profile">Profile</router-link>
        </ul>
    </div>
    <div @click="openMenu" :class="isOpen ? 'block' : 'hidden'" class="inset-0 fixed"></div>
</template>