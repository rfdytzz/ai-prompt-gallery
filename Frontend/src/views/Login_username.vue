<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';

const isShow = ref(false)
const showHidePassword = () => {
    isShow.value = !isShow.value
}

const show = ref(false)
const router = useRouter()
const username = ref('')
const password = ref('')
const message = ref('')

const login = async () => {
    try {
        const res = await axios.post('http://localhost:8000/api/login/username',
            {
                username: username.value,
                password: password.value
            }
        )
        localStorage.setItem('token', res.data.token)
        router.push('/')
    } catch (error) {
        show.value = true
        console.log(error)
        message.value = error.response.data.message
    }
}

const hideMessage = () => {
    show.value = false
}

onMounted( () => {
    document.title = 'Login'
})

</script>

<template>
    <div class="w-full h-screen items-center justify-center flex flex-col">
        <div class="bg-white gap-5 px-11 pt-5 py-5 md:px-5 lg:px-5 pb-10 w-110 text-black shadow-none md:shadow lg:shadow focus-within:shadow-none md:focus-within:shadow-xl lg:focus-within:shadow-xl transition duration-200">
            <div class="mb-5 bg-white justify-center w-full rounded-xl flex shadow">
                <router-link to="/login" class="flex-1 p-3 text-center">With Email</router-link>
                <router-link to="/login/username" class="p-3 bg-gray-100 shadow flex-1 text-center">With Username</router-link>
            </div>
            <h1 class="font-bold text-[34px] text-center text-blue-600">Login</h1>
            <div v-if="show" class="p-4 mt-5 bg-red-100 rounded-xl text-red-700 flex items-center justify-between">{{ message }}<i class='bx bx-x text-[20px] cursor-pointer' @click="hideMessage" ></i></div>
            <form @submit.prevent="login" action="" class="mt-5 flex-col flex gap-5">
                <div class="flex-col flex gap-3">
                    <label for="email" class="text-[15px]">Username <span class="text-orange-500">*</span></label>
                    <input v-model="username" required placeholder="Username" type="text" name="email" class="p-3 bg-gray-100 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                    <p class="text-[13px] text-gray-500">Use your registered username</p>
                </div>
                <div class="flex-col flex gap-3">
                    <label for="email" class="text-[15px]">Password <span class="text-orange-500">*</span></label>
                    <div class="flex pr-3 items-center justify-between bg-gray-100 focus-within:bg-white transition duration-200 ring-1 rounded-xl ring-gray-200 focus-within:ring-blue-500 gap-1">
                        <input v-model="password" required placeholder="󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏" minlength="8" :type="isShow ? 'text' : 'password'" name="password" class="p-3 focus:outline-0 flex-1" id="">
                        <i @click="showHidePassword" :class="isShow ? 'bx-show' : 'bx-hide'" class='bx text-[22px] cursor-pointer'></i>
                    </div>
                    <p class="text-[13px] text-gray-500">Password must be at least 8 characters</p>
                </div>

                <button type="submit" class="font-bold text-[20px] mt-5 p-2 rounded-xl bg-blue-500 hover:bg-blue-400 transition duration-100 text-white cursor-pointer">Login</button>
                <p class="text-[15px] text-gray-900 text-center">Dont have an account? <router-link to="/register" class="text-blue-500 hover:underline">Register</router-link></p>
            </form>
        </div>
    </div>
</template>