<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';


const isShow = ref(false)
const showHidePassword = () => {
    isShow.value = !isShow.value
}

const router = useRouter()
const email = ref('')
const password = ref('')
const message = ref('')
const login = async () => {
    try {
        const res = await axios.post('http://localhost:8000/api/login',
            {
                email: email.value,
                password: password.value
            }
        )
        localStorage.setItem('token', res.data.token)
        router.push('/')
        console.log(res.data) 
    } catch (error) {
        // console.log(error)
        console.log(error?.response?.data?.message)
        message.value = error?.response?.data?.message
    }
}

const isMessage = ref(true)
const hideMessage = () => {
    isMessage.value = !isMessage.value
}

</script>

<template>
    <div class="w-full h-fit py-10 items-center justify-center flex flex-col">
        <div class="bg-white gap-5 px-11 md:px-5 lg:px-5 py-10 w-130 text-black shadow-none md:shadow lg:shadow focus-within:shadow-none md:focus-within:shadow-xl lg:focus-within:shadow-xl transition duration-200">
            <h1 class="font-bold text-[34px] text-center text-blue-600">Register</h1>
            <div :class="isMessage ? 'block' : 'hidden'" v-if="message" class="p-4 mt-5 bg-red-100 rounded-xl text-red-700 flex items-center justify-between">{{ message }}<i class='bx bx-x text-[20px] cursor-pointer' @click="hideMessage" ></i></div>
            <form @submit.prevent="login" action="" class="mt-5 flex-col flex gap-5">
                <div class="flex-col flex gap-3">
                    <label for="name" class="text-[18px]">Name <span class="text-orange-500">*</span></label>
                    <input v-model="name" required placeholder="Your Name" type="text" name="name" class="p-3 bg-gray-100 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                    <p class="text-[13px] text-gray-500">Use your Real Name</p>
                </div>
                <div class="flex-col flex gap-3">
                    <label for="name" class="text-[18px]">Username <span class="text-orange-500">*</span></label>
                    <input v-model="username" required placeholder="Username" type="text" name="name" class="p-3 bg-gray-100 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                </div>
                <div class="flex-col flex gap-3">
                    <label for="email" class="text-[18px]">Email <span class="text-orange-500">*</span></label>
                    <input v-model="email" required placeholder="example@email.com" type="email" name="email" class="p-3 bg-gray-100 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                    <p class="text-[13px] text-gray-500">Use your unregistered email</p>
                </div>
                <div class="flex-col flex gap-3">
                    <label for="email" class="text-[18px]">Password <span class="text-orange-500">*</span></label>
                    <div class="flex pr-3 items-center justify-between bg-gray-100 focus-within:bg-white transition duration-200 ring-1 rounded-xl ring-gray-200 focus-within:ring-blue-500 gap-1">
                        <input v-model="password" required placeholder="󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏" minlength="8" :type="isShow ? 'text' : 'password'" name="password" class="p-3 focus:outline-0 flex-1" id="">
                        <i @click="showHidePassword" :class="isShow ? 'bx-show' : 'bx-hide'" class='bx text-[22px] cursor-pointer'></i>
                    </div>
                    <p class="text-[13px] text-gray-500">Password must be at least 8 characters</p>
                </div>

                <button class="font-bold text-[20px] mt-5 p-2 rounded-xl bg-blue-500 hover:bg-blue-400 transition duration-100 text-white cursor-pointer">Register</button>
                <p class="text-[15px] text-gray-900 text-center">have an account? <router-link to="/login" class="text-blue-500 hover:underline">Login</router-link></p>
            </form>
        </div>
    </div>
</template>