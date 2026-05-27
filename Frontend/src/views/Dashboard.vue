<script setup>
import Admin from '@/components/Admin.vue';
import axios from 'axios';
import { onMounted, ref, nextTick } from 'vue';
import Chart from 'chart.js/auto'

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

const date = new Date().toLocaleString('en-US', {weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'})
const time = new Date().toLocaleTimeString('id-ID')

onMounted(async () => {
    await getUser()
    await getData()
    await nextTick()
    const ctx = document.getElementById('myChart')

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['User', 'Prompt', 'Category', 'Tag '],
            datasets: [{
            label: 'Total',
            data: [
                data.value.totalUser,
                data.value.totalPrompt,
                data.value.totalCategory,
                data.value.totalTag,
            ],
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true,
            max: 50
            }
        }
        }
    });

})

</script>

<template>
    <Admin />
    <div class="ml-64 h-20 items-center px-5 flex justify-between">
        <router-link to="/dashboard" class="relative hover:text-blue-500">Dashboard</router-link>
    </div>

    <div class="items-center pb-10 grid grid-cols-4 w-full gap-5 pl-69 pt-2 pr-5 justify-between">
        <div class="shadow flex justify-between items-center p-5 col-span-4 rounded hover:shadow-xl transition duration-100 border border-gray-200">
            <h1 class="font-normal text-sm">Hi! Welcome back <span class="font-semibold">{{ name }}</span></h1>
            <p class="text-sm">{{ date }}, {{ time }} WIB</p>
        </div>
        <div class="shadow p-5 flex flex-col gap-2 col-span-1 rounded hover:shadow-xl transition duration-100 border border-gray-200">
            <div class="font-normal text-sm flex items-center gap-2"><i class='bx bx-user' ></i> Total User</div>
            <h2 class="text-4xl">{{ data.totalUser }}</h2>
        </div>
        <div class="shadow p-5 flex flex-col gap-2 col-span-1 rounded hover:shadow-xl transition duration-100 border border-gray-200">
            <div class="font-normal text-sm flex items-center gap-2"><i class='bx bx-command' ></i> Total Prompt</div>
            <h2 class="text-4xl">{{ data.totalPrompt }}</h2>
        </div>
        <div class="shadow p-5 flex flex-col gap-2 col-span-1 rounded hover:shadow-xl transition duration-100 border border-gray-200">
            <div class="font-normal text-sm flex items-center gap-2"><i class='bx bx-category' ></i> Total Caategory</div>
            <h2 class="text-4xl">{{ data.totalCategory }}</h2>
        </div>
        <div class="shadow p-5 flex flex-col gap-2 col-span-1 rounded hover:shadow-xl transition duration-100 border border-gray-200">
            <div class="font-normal text-sm flex items-center gap-2"><i class='bx bx-tag' ></i> Total Tag</div>
            <h2 class="text-4xl">{{ data.totalTag }}</h2>
        </div>
        <div class="shadow p-5 flex flex-col gap-2 col-span-3 row-span-2  rounded hover:shadow-xl transition duration-100 border border-gray-200">
            <div class="font-normal text-sm flex items-center gap-2"><i class='bx bx-chart' ></i> Chart</div>
            <canvas id="myChart"></canvas>
        </div>
    </div>
</template>