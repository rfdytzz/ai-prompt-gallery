<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';


const user = ref({})
const router = useRouter()

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

const logout = async () => {
    const Mconfirm = confirm('Sure to logout?')
    if (!Mconfirm) {
        return 
    }
    try {
        const token = localStorage.getItem('token')
        await axios.post('http://localhost:8000/api/logout',
            {},
            {
                headers: {
                    Authorization: `bearer ${token}`
                }
            }
        )
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
    <div class="bg-gray-900 justify-between fixed z-50 flex items-center w-full h-23 text-white p-5">
        <h1 @click="openMenu" class="font-bold text-[30px]">Lo<span class="text-lime-500">go</span></h1>
        <div class="hidden md:block lg:block">
            <ul class="flex gap-5">
                <router-link to="" class="text-lime-500 transition duration-200">Home</router-link>
                <router-link to="" class="hover:text-lime-500 transition duration-200">About</router-link>
                <router-link to="" class="hover:text-lime-500 transition duration-200">Prompt</router-link>
            </ul>
        </div>
        <div class="flex gap-5 items-center">
            <div @click="openMenu" class="cursor-pointer">{{ user.name }} <i class='bx bx-chevron-down'></i></div>
        </div>
    </div>
    <ul :class="isOpen ? 'translate-y-0' : '-translate-y-full'" class="flex text-white flex-col fixed z-40 transition duration-100 top-20 bg-gray-900 w-40 right-2 rounded border-4 border-gray-500">
        <router-link to="" class="flex items-center gap-2 hover:bg-gray-800 px-3 py-3"><i class='bx bx-user-circle' ></i> Profile</router-link>
        <router-link to="" class="flex items-center gap-2 hover:bg-gray-800 px-3 py-3"><i class='bx bx-cog' ></i> Profile</router-link>
        <button @click="logout" class="flex items-center cursor-pointer gap-2 bg-red-800 hover:bg-red-700 px-3 py-3"><i class='bx bx-log-out' ></i> Logout</button>
    </ul>
</template>