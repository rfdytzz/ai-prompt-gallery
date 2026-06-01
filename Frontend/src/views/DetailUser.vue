<script setup>
import Admin from '@/components/Admin.vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute()
const id = route.params.id
const data = ref({})
const getData = async () => {
    try {
        const res = await axios.get(`http://localhost:8000/api/dashboard/allusers/${id}`)
        data.value = res.data.data
        console.log(res.data.data)
    } catch (error) {
        console.log(error)
    }
}

const ban = async () => {
    try {
        const isconfirm = confirm('ban?')
        if (!isconfirm) {
            return 
        }
        await axios.get(`http://localhost:8000/api/dashboard/allusers/${id}/ban`)
        await getData()
    } catch (error) {
        console.log(error)
    }
}

const unban = async () => {
    const isconfirm = confirm('unban?')
    if (!isconfirm) {
        return
    }
    try {
        await axios.get(`http://localhost:8000/api/dashboard/allusers/${id}/unban`)
        await getData()
    } catch (error) {
        console.log(error)
    }
}

onMounted(() => {
    getData()
})

</script>

<template>
    <Admin />
    <div v-if="loading" class="fixed top-0 h-1 bg-blue-500 w-full"></div>
    <div class="ml-64 h-20 items-center px-5 flex">
        <router-link to="/dashboard/allusers" class="relative hover:text-blue-500">All User</router-link>
        <i class='bx bx-chevron-right mt-1'></i>
        <router-link to="/dashboard/allusers" class="relative hover:text-blue-500">{{ data.name }}</router-link>
    </div>

    <div class="items-center pb-5 grid grid-cols-4 w-full gap-5 pl-69 pt-2 pr-5">
        <div class="shadow flex w-full flex-col justify-between items-start gap-4 p-5 col-span-4 rounded hover:shadow transition duration-100 border border-gray-200">
            <h4 class="text-xl font-semibold">{{ data.name }}</h4>
            <button @click="ban" v-if="data.status === 'active'" class="p-3 hover:bg-red-600 transition duration-200 cursor-pointer bg-red-500 flex items-center text-white rounded-xl font-semibold gap-2 justify-center"><i class='bx bx-block'></i>Ban <p class="font-normal">{{ data.name }}</p></button>
            <button @click="unban" v-if="data.status === 'banned'" class="p-3 hover:bg-green-600 transition duration-200 cursor-pointer bg-green-500 flex items-center text-white rounded-xl font-semibold gap-2 justify-center"><i class='bx bx-user-check'></i>Unban <p class="font-normal">{{ data.name }}</p></button>
        </div>
    </div>
</template>