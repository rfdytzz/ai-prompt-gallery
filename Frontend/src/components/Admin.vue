<script setup>
import axios from 'axios';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute()
const router = useRouter()

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

</script>

<template>
    <div class="w-64 p-5 fixed flex justify-between flex-col z-50 left-0 top-0 h-screen shadow-xl border-r-2 border-gray-200">
        <div class="flex flex-col gap-10">
            <div class="flex flex-col">
                <h1 class="font-semibold text-xl">Dashboard</h1>
                <p class="font-bold text-2xl">D<span class="text-blue-500">way</span> Prompt</p>
            </div>
            <ul class="flex text-sm flex-col gap-1">
                <router-link :class="route.path === '/dashboard' ? 'bg-gray-100' : ''" class="font-semibold hover:bg-gray-100 rounded-xl transition duration-100 p-3 flex gap-2 items-center" to="/dashboard" ><i class='bx bx-tachometer'></i> Dashboard</router-link>
                <router-link :class="route.path === '/dashboard/allusers' ? 'bg-gray-100' : ''" class="font-semibold hover:bg-gray-100 rounded-xl transition duration-100 p-3 flex gap-2 items-center" to="/dashboard/allusers"><i class='bx bxs-user-account' ></i> All Users</router-link>
                <router-link :class="route.path === '/dashboard/prompt' ? 'bg-gray-100' : ''" class="font-semibold hover:bg-gray-100 rounded-xl transition duration-100 p-3 flex gap-2 items-center" to="/dashboard/prompt"><i class='bx bx-command' ></i> Prompt Management</router-link>
            </ul>
        </div>
        <button @click="logout" class="bg-red-500 border-2 border-red-700 hover:bg-red-700 transition duration-100 p-3 flex gap-2 items-center justify-center text-white cursor-pointer rounded-xl"><i class='bx bx-log-out' ></i> Logout</button>
    </div>
</template>