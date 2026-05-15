<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';


const user = ref({})

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

onMounted( () => {
    getData()
})

</script>

<template>
    <div class="bg-gray-900 justify-between flex items-center w-full h-23 text-white p-5">
        <h1 class="font-bold text-[30px]">Lo<span class="text-lime-500">go</span></h1>
        <ul class="flex gap-5">
            <router-link to="">Home</router-link>
            <router-link to="">About</router-link>
            <router-link to="">Prompt</router-link>
        </ul>
        <p>{{ user.name }}</p>
    </div>
</template>