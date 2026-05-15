<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const isShow = ref(false)

const showPassword = () => {
    isShow.value = !isShow.value
}

const isHide = ref(false)

const hideSession = () => {
    isHide.value = !isHide.value
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
    } catch (error) {
        console.log(error)
        message.value = error.response.data.message
    }
}

</script>

<template>
    <div class="w-full bg-gray-900 flex justify-center items-center h-screen">
        <div class="bg-gray-900 w-100 px-5 border-0 md:border-4 lg:border-4 border-gray-600 rounded focus-within:border-lime-500 transition duration-200 pb-8 pt-10">
            <h1 class="text-[40px] mb-5 text-white font-bold text-center">Log<span class="text-lime-500">in</span></h1>
            <div v-if="message" :class="isHide ? 'hidden' : 'block'" class="flex justify-between items-center my-5 bg-red-500/20 text-red-300 p-3 border-2 border-red-500">
                {{ message }}
                <i class='bx bx-x cursor-pointer text-[18px]' @click="hideSession"></i>
            </div>
            <form @submit.prevent="login" action="" class="flex w-full flex-col gap-5 text-white">
                <div class="flex flex-col gap-2">
                    <label for="">Email <span class="text-orange-500">*</span></label>
                    <input type="email" v-model="email" required class="flex-1 p-3 transition duration-200 rounded focus:outline-0 outline-2 outline-gray-500 focus:outline-2 focus:outline-lime-500" placeholder="example@email.com" name="" id="">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="">Password <span class="text-orange-500">*</span></label>
                    <input v-model="password" :type="isShow ? 'text' : 'password'" required minlength="8" class="flex-1 p-3 transition duration-200 rounded focus:outline-0 outline-2 outline-gray-500 focus:outline-2 focus:outline-lime-500" placeholder="Password" name="" id="">
                    <div class="flex justify-between">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" @click="showPassword" name="" id=""><span class="text-[15px]">Show Password</span>
                        </div>
                        <a href="" class="text-[15px] text-lime-500 hover:text-lime-400">Forgot Password?</a>
                    </div>
                </div>
                <button type="submit" class="font-bold text-[20px] p-2 cursor-pointer mt-5 bg-lime-500/50 border-2 border-lime-500 hover:bg-lime-500 transition duration-200 rounded">Login</button>
                <p class="ext-[15px] text-center">Dont have an Account? <a href="" class="text-lime-500 hover:text-lime-400">Register</a></p>
            </form>
        </div>
    </div>
</template>