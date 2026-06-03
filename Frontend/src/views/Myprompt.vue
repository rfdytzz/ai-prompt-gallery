<script setup>
import Nav from '@/components/Nav.vue';
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import { onMounted } from 'vue';
import axios from 'axios';
onMounted(() => {
    document.title = 'Myprompt | DwayPrompts'
})

const route = useRoute()
const search = ref('')
const data = ref([])
const getData = async () => {
    try {
        const token = localStorage.getItem('token')
        const res = await axios.get('http://localhost:8000/api/myprompt',
            {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }
        );
        data.value = res.data.data
        console.log(res.data.data)
    } catch (error) {
        console.log(error)
    }
}

onMounted(() => (
    getData()
));

</script>

<template>
    <Nav />
    <div class="w-full pt-27 px-3 md:px-7 h-fit pb-10">
        <div class="flex flex-col md:flex-row gap-5">
            <div class="w-full hidden md:block md:fixed md:w-80 h-fit md:h-fit shadow rounded-xl p-4">
                <ul class="flex flex-col gap-3">
                    <router-link to="/profile" :class="route.path === '/profile' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 p-3 hover:shadow-none shadow rounded-xl"><i class='bx bx-user-circle' ></i> Profile</router-link>
                    <router-link to="/profile/myprompt" :class="route.path === '/profile/myprompt' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 shadow p-3 rounded-xl"><i class='bx bx-command' ></i> My Prompt</router-link>
                    <router-link to="/settings" :class="route.path === '/settings' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 shadow p-3 rounded-xl"><i class='bx bx-cog' ></i> Settings</router-link>
                    <router-link to="/change-password" :class="route.path === '/change-password' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 shadow p-3 rounded-xl"><i class='bx bx-lock-alt' ></i> Change Password</router-link>
                </ul>
            </div>
            <div class="w-full md:ml-85 md:w-full h-fit pb-10 md:h-fit shadow rounded-xl p-4">
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col">
                        <h2 class="font-bold text-[30px]">Myprompt</h2>
                        <p>Manage your Prompt</p>
                    </div>
                    <router-link to="/profile/myprompt/create" class="w-fit bg-blue-500 cursor-pointer transition duration-200 hover:bg-blue-600 hover:text-white px-3 py-2 rounded-xl text-blue-100 flex flex-row gap-2 items-center mt-5 md:mt-5">
                        <i class='bx bx-add-to-queue'></i> Add New Prompt
                    </router-link>
                    <input type="search" v-model="search" placeholder="Search your Prompt" class="flex-1 w-full focus:ring-blue-500 max-w-full ring-1 px-3 transition duration-200 rounded-xl ring-gray-300 bg-gray-50 focus:bg-white py-3 focus:outline-0" name="" id="">
                    <div class="grid gap-5 grid-cols-1 md:grid-cols-3">
                        <div v-for="(item, index) in data.filter(i => i.title.toLowerCase().includes(search.toLowerCase()))" :key="index" class="shadow pb-5 hover:shadow-xl transition duration-200 flex flex-col gap-3 overflow-hidden rounded-xl">
                            <div class="w-full h-50">
                                <img :src="`http://localhost:8000/storage/${item.thumbnail}`" class="hover:scale-110 w-full transition duration-200" alt="">
                            </div>
                            <div class="px-5 relative z-30 bg-white pt-2 flex flex-col gap-3">
                                <h3 class="text-xl font-semibold">{{ item.title }}</h3>
                                <p class="h-25 overflow-x-auto">{{ item.prompt }}</p>
                            </div>
                            <div class="px-5 mt-2 flex gap-2 justify-end">
                                <router-link :to="`/profile/myprompt/edit/${item.id}`" class="cursor-pointer rounded bg-yellow-500 text-white hover:bg-yellow-400 transition duration-100 px-4 py-2">Edit</router-link>
                                <button class="cursor-pointer rounded bg-red-500 text-white hover:bg-red-400 transition duration-100 px-4 py-2">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>