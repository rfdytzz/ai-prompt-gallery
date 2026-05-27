<script setup>
import Admin from '@/components/Admin.vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';

const search = ref('')
const data = ref([])
const getData = async () => {
    try {
        const res = await axios.get('http://localhost:8000/api/dashboard/allusers')
        data.value = res.data.data
        console.log(res.data)
    } catch (error) {
        console.log(error)
        console.log('')
    }
}

onMounted(() => {
    getData()
})
</script>

<template>
    <Admin />
    <div class="ml-64 h-20 items-center px-5 flex justify-between">
        <router-link to="/dashboard/allusers" class="relative hover:text-blue-500">All User</router-link>
    </div>

    <div class="items-center pb-5 grid grid-cols-4 w-full gap-5 pl-69 pt-2 pr-5">
        <div class="shadow flex w-full flex-col justify-between items-start gap-4 p-5 col-span-4 rounded hover:shadow transition duration-100 border border-gray-200">
            <h1 class="font-normal text-sm">Search All User <span class="font-semibold">{{ name }}</span></h1>
            <input v-model="search" type="search" placeholder="Search for users by name and username" class="focus:outline-0 p-3 w-full ring ring-gray-300 bg-gray-50 focus:bg-white transition focus:shadow duration-100 focus:ring-blue-500 rounded-xl">
        </div>
    </div>
    <div class="w-full h-fit pl-69 pr-5">
        <div class="flex items-center justify-between">
            <div class="flex mb-5 gap-2">
                <button @click="latest" class="py-2 px-3 bg-blue-500 text-white rounded-xl cursor-pointer">Latest</button>
                <button @click="oldest" class="py-2 px-3 hover:bg-blue-100 transition duration-200 bg-gray-100 rounded-xl cursor-pointer">Oldest</button>
            </div>
            <div class="flex items-center gap-2">
                <div class="flex items-center bg-green-500 text-white p-1 rounded gap-2">
                    <i class='bx bx-show' ></i> <p>Detail</p>
                </div>
            </div>
        </div>
        <div class="w-full shadow h-fit">
            <table class="w-full">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="p-3 text-start">No</th>
                        <th class="p-3 text-start">ID</th>
                        <th class="p-3 text-start">Name</th>
                        <th class="p-3 text-start">Username</th>
                        <th class="p-3 text-start">Email</th>
                        <th class="p-3 text-start">Created At</th>
                        <th class="p-3 text-start">Status</th>
                        <th class="p-3 text-start">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-100">
                    <tr v-for="(item, index) in data.filter(i => i.name.toLowerCase().includes(search.toLowerCase()))" class="hover:bg-blue-50 border-b border-blue-200 transition duration-50">
                        <td class="p-3 text-start">{{ index + 1 }}</td>
                        <td class="p-3 text-start">{{ item.id }}</td>
                        <td class="p-3 text-start">{{ item.name }}</td>
                        <td class="p-3 text-start">@{{ item.username }}</td>
                        <td class="p-3 text-start">{{ item.email }}</td>
                        <td class="p-3 text-start">{{ item.created_at.split('T')[0] }}, {{ item.created_at.split('T')[1].substring(0, 5) }} WIB</td>
                        <td :class="item.status === 'active' ? 'text-green-700' : 'text-red-700'" class="p-3 text-start capitalize">{{ item.status }}</td>
                        <td class="p-3 text-start flex gap-2">
                            <!-- <button class="p-2 bg-yellow-500 items-center flex rounded text-white hover:bg-yellow-600 transition duration-100 cursor-pointer"><i class='bx bxs-edit' ></i></button> -->
                            <router-link :to="`/dashboard/allusers/${item.id}`" @click="detail" class="p-2 bg-green-500 items-center flex rounded text-white hover:bg-green-600 transition duration-100 cursor-pointer"><i class='bx bx-show' ></i></router-link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>