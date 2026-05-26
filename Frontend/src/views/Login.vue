<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';


const isShow = ref(false)
const showHidePassword = () => {
    isShow.value = !isShow.value
}

const show = ref(false)
const router = useRouter()
const email = ref('')
const password = ref('')
const message = ref('')
const loading = ref(false)
const login = async () => {
    try {
        loading.value = true
        const res = await axios.post('http://localhost:8000/api/login',
            {
                email: email.value,
                password: password.value
            }
        )
        localStorage.setItem('token', res.data.token)
        localStorage.setItem('role', res.data.user.role)
        await router.push(role === 'admin' ? '/dashboard' : '/')
        console.log(res.data) 
    } catch (error) {
        // console.log(error)
        show.value = true
        console.log(error?.response?.data?.message)
        message.value = error?.response?.data?.message
    } finally {
        loading.value  = false
    }
}
const hideMessage = () => {
    show.value = false
}

</script>

<template>
    <div v-if="loading" class="fixed top-0 h-1 bg-blue-500 w-full"></div>
    <div class="w-full h-screen items-center justify-center flex flex-col">
        <div class="bg-white gap-5 px-11 pt-5 py-5 md:px-5 lg:px-5 pb-10 w-110 text-black shadow-none md:shadow lg:shadow focus-within:shadow-none md:focus-within:shadow-xl lg:focus-within:shadow-xl transition duration-200">
            <div class="mb-5 bg-white justify-center w-full rounded-xl flex shadow">
                <router-link to="/login" class="bg-gray-50 rounded-xl shadow flex-1 p-3 text-center">With Email</router-link>
                <router-link to="/login/username" class="p-3 flex-1 text-center">With Username</router-link>
            </div>
            <h1 class="font-bold text-4xl text-center text-blue-600">Login</h1>
            <div v-if="show" class="p-4 mt-5 bg-red-500/20 rounded-xl text-red-700 flex items-center justify-between">{{ message }}<i class='bx bx-x text-[20px] cursor-pointer' @click="hideMessage" ></i></div>
            <form @submit.prevent="login" action="" class="mt-5 flex-col flex gap-5">
                <div class="flex-col flex gap-3">
                    <label for="email" class="text-sm">Email <span class="text-orange-500">*</span></label>
                    <input v-model="email" required placeholder="example@email.com" type="email" name="email" class="p-3 bg-gray-50 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                    <p class="text-[13px] text-gray-500">Use your registered email</p>
                </div>
                <div class="flex-col flex gap-3">
                    <label for="email" class="text-sm">Password <span class="text-orange-500">*</span></label>
                    <div class="flex pr-3 items-center justify-between bg-gray-50 focus-within:bg-white transition duration-200 ring-1 rounded-xl ring-gray-200 focus-within:ring-blue-500 gap-1">
                        <input v-model="password" required placeholder="󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏" minlength="8" :type="isShow ? 'text' : 'password'" name="password" class="p-3 focus:outline-0 rounded-l-xl flex-1" id="">
                        <i @click="showHidePassword" :class="isShow ? 'bx-hide' : 'bx-show'" class='bx text-[22px] pl-2 cursor-pointer'></i>
                    </div>
                    <p class="text-[13px] text-gray-500">Password must be at least 8 characters</p>
                </div>

                <button type="submit" class="font-bold text-[20px] mt-5 p-2 rounded-xl bg-blue-500 hover:bg-blue-400 transition duration-100 text-white cursor-pointer">Login</button>
                <p class="text-[15px] text-gray-900 text-center">Dont have an account? <router-link to="/register" class="text-blue-500 hover:underline">Register</router-link></p>
            </form>
        </div>
    </div>
</template>